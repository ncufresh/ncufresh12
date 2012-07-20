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

    public function actionContent()
    {
        $club = new Club();
		$page = (integer)$_GET['id'];
        $data = $club->getClub($page);
        $this->render('content', array(
            'data'      => $data
        ));
    }
}