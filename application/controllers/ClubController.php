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
        $data = $club->getClub(1);
        $this->render('content', array(
            'data'      => $data
        ));
    }
}