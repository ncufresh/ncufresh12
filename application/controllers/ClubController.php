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
        //$data = $club->getClub($id); */
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
        $this->render('modify',array('data'=>$club,'id'=>$id)); 
        
	} 
}