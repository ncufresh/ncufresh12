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
        $this->render('club');
    }

    public function actionStudent()
    {
        $this->render('student');
    }

    public function actionDepartment()
    {
        $this->render('department');
    }

    public function actionContent($id)
    {
        $id = (integer)$id;
        if ( Club::model()->findByPK($id) )
        {
            $master_id = Club::model()->findByPK($id)->master_id;
            $is_subscript = Subscription::model()->getIsSubscriptByClubID($master_id);
        }
        $this->render('content', array(
            'data'          => Club::model()->findByPk($id),
			'id'		    => $id,
            'is_subscript' => $is_subscript
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
        $this->render('uploadpicture', array(
            'id'    => $id
        ));
    }
}