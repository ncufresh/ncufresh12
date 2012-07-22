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
	public function actionModify()
	{
		$model = new Club();
		$leader -> leader => $_POST['leader'];
	}
}