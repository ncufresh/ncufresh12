<?php 

class ClubController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
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
        $club = new Club();
        $data = $club->getClub($id);
        $this->render('content', array(
            'data'      => $data,
			'id'		=> $id
        ));
        
    }
 	public function actionModify($id)
	{
        $id = (integer)$id; 
        $club = new Club();
        $club = $club->getClub($id);
        if(isset($_POST['club']))
        {
            $club->introduction = $_POST['club']['introduction'];
            $club->leader = $_POST['club']['leader'];
            $club->leader_phone = $_POST['club']['leader_phone'];
            $club->leader_e_mail = $_POST['club']['leader_email'];
            $club->leader_binary_id = $_POST['club']['leader_ID'];
            $club->leader_msn = $_POST['club']['leader_msn'];
            $club->viceleader = $_POST['club']['viceleader'];
            $club->viceleader_phone = $_POST['club']['viceleader_phone'];
            $club->viceleader_e_mail = $_POST['club']['viceleader_email'];
            $club->viceleader_binaryid = $_POST['club']['viceleader_ID'];
            $club->viceleader_msn = $_POST['club']['viceleader_msn'];
            $club->club_web = $_POST['club']['web'];
            if($club->save())
            {
                $this->redirect(array("club/content/$id"));
            } 
        }
    
        $this->_data['token'] = Yii::app()->security->getToken(); 
        $this->render('modify',array(
            'data'=>$club,
            'id'=>$id
        )); 
        
	}
    public function actionUploadpicture($id)
    {
        $id = (integer)$id;
        $model = new Club();
        /* $userID = Yii::app()->user->id;
        $model = $model->getClub($id); 
        $manager = findAll( $model->manager_id AND $userID );*/
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'club/' . $id;
        if ( isset($_FILES['pictures']) )
        {
            for ( $index = 0 ; $index < 4 ; ++$index )
            {
                if ( empty($_FILES['pictures']['name'][$index]) ) continue;
                $file = $path . DIRECTORY_SEPARATOR . ($index + 1) . '.jpg';
                if ( file_exists($file) ) unlink($file);
                move_uploaded_file($_FILES['pictures']['tmp_name'][$index], $file);
            }
            $this->redirect(array("club/content/$id"));
        }
        $this->render('uploadpicture',array(
            'id'=>$id,
        ));
    } 
}