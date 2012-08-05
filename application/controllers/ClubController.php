<?php 

class ClubController extends Controller
{   
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions'   => array(
                    'index',
                    'club',
                    'department',
                    'student',
                    'content'
                ),
                'users'     => array('*')
            ),
            array(
                'allow',
                'users'     => array('@')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    public function actionIndex()
    {
        $this->redirect(array('club'));
    }

    public function actionClub()
    {
        $this->setPageTitle(Yii::app()->name . ' - 社團列表');
        $this->render('club');
    }

    public function actionStudent()
    {
        $this->setPageTitle(Yii::app()->name . ' - 學生組織列表');
        $this->render('student');
    }

    public function actionDepartment()
    {
        $this->setPageTitle(Yii::app()->name . ' - 系所列表');
        $this->render('department');
    }

    public function actionContent($id)
    {
        $id = (integer)$id;
        $club = Club::model()->findByPk($id);
        if ( $club )
        {
            $is_subscript = Subscription::model()->getIsSubscriptByClubID($id);
        }

        $this->setPageTitle(Yii::app()->name . ' - ' . $club->name);
        $this->render('content', array(
            'data'          => $club,
			'id'		    => $id,
            'is_subscript'  => $is_subscript
        )); 
    }

 	public function actionModify($id)
	{
        $id = (integer)$id; 
        $club = new Club();
        $club = $club->findByPk($id);
        $club->introduction = $club->getRawValue('introduction');

        if ( ! $club->getIsAdmin($id) ) throw new CHttpException(404);

        if ( isset($_POST['club']) )
        {
            $club->attributes = $_POST['club'];
            if ( $club->save() )
            {
                $this->redirect(array(
                    'content',
                    'id'    =>  $id
                ));
            } 
        }

        $this->setPageTitle(Yii::app()->name . ' - 修改社團資料');
        $this->render('modify', array(
            'data'      => $club,
            'id'        => $id
        ));
	}

    public function actionUploadpicture($id)
    {
        $id = (integer)$id;
        $uptypes = array(
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png'
        );
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'clubs'. DIRECTORY_SEPARATOR . $id;

        if ( ! Club::model()->getIsAdmin($id) ) throw new CHttpException(404);

        if ( isset($_FILES['pictures']) )
        {
            for ( $index = 0 ; $index < 3 ; ++$index )
            {
                $filetype[$index] =  $_FILES['pictures']['type'][$index];
                if ( in_array($filetype[$index], $uptypes) )
                {
                    if ( empty($_FILES['pictures']['name'][$index]) ) continue;
                    if ( ! is_dir($path) )
                    {
                       mkdir($path);
                       chmod($path, 0755);
                    }
                    $file = $path . DIRECTORY_SEPARATOR . ($index + 1) . '.jpg';
                    if ( file_exists($file) ) unlink($file);
                    move_uploaded_file($_FILES['pictures']['tmp_name'][$index], $file);
                }
            }

            $this->redirect(array(
                'content',
                'id'    => $id
            ));
        }

        $this->setPageTitle(Yii::app()->name . ' - 上傳照片');
        $this->render('uploadpicture', array(
            'id'    => $id
        ));
    }
}