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
        $img_url = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . "club/$id";
        $name = " ";
        $status1 = " ";
        $status2 = " ";
        $status3 = " ";
        $status4 = " ";
        $path = dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . "club/$id";
        if(isset($_POST['pic1']))
        {
            if(isset($_FILES['picture1']['name']))
            {
                $name = $_FILES['picture1']['name'];
                $target = $path . DIRECTORY_SEPARATOR . $name;
                if(file_exists("$path/1.jpg"))
                {
                    unlink("$path/1.jpg");
                }
                move_uploaded_file($_FILES['picture1']['tmp_name'], $target);
                $temp = $_FILES['picture1']['tmp_name'];
                rename($target,"$path/1.jpg");
                $picture_size = $_FILES['picture1']['size'];
                $picture_type = $_FILES['picture1']['type'];
                $status1 = "檔案已上傳";
            }
        }
        if(isset($_POST['pic2']))
        {
            $name = $_FILES['picture2']['name'];
            $target = $path . DIRECTORY_SEPARATOR . $name;
            if(file_exists("$path/2.jpg"))
            {
                unlink("$path/2.jpg");
            }
            move_uploaded_file($_FILES['picture2']['tmp_name'], $target);
            $temp = $_FILES['picture2']['tmp_name'];
            rename($target,"$path/2.jpg");
            $picture_size = $_FILES['picture2']['size'];
            $picture_type = $_FILES['picture2']['type'];
            $status2 = "檔案已上傳";
        } 
        if(isset($_POST['pic3']))
        {
            $name = $_FILES['picture3']['name'];
            $target = $path . DIRECTORY_SEPARATOR . $name;
            if(file_exists("$path/3.jpg"))
            {
                unlink("$path/3.jpg");
            }
            move_uploaded_file($_FILES['picture3']['tmp_name'], $target);
            $temp = $_FILES['picture3']['tmp_name'];
            rename($target,"$path/3.jpg");
            $picture_size = $_FILES['picture3']['size'];
            $picture_type = $_FILES['picture3']['type'];
            $status3 = "檔案已上傳";
        }
        if(isset($_POST['pic4']))
        {
            $name = $_FILES['picture4']['name'];
            $target = $path . DIRECTORY_SEPARATOR . $name;
            if(file_exists("$path/4.jpg"))
            {
                unlink("$path/4.jpg");
            }
            move_uploaded_file($_FILES['picture4']['tmp_name'], $target);
            $temp = $_FILES['picture4']['tmp_name'];
            rename($target,"$path/4.jpg");
            $picture_size = $_FILES['picture4']['size'];
            $picture_type = $_FILES['picture4']['type'];
            $status4 = "檔案已上傳";
        }
        if(isset($_POST['return']))
        {
            $this->redirect(array("club/content/$id"));
        }
        
        $this->render('uploadpicture',array(
            'id'=>$id,
            'status1'=>$status1,
            'status2'=>$status2,
            'status3'=>$status3,
            'status4'=>$status4
        ));
    } 
}