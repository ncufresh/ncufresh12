<?php

class FriendsController extends Controller
{

    public function actionFriends() //好友專區
    {
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            if($id=='1') //同系同屆 
            {
                $this->redirect(array('site/samedepartment_samegrade'));
                
            }
            else if($id=='2') //同系不同屆
            {
                $this->redirect(array('site/samedepartment_diffgrade'));
                
            }
            else if($id=='3')  //其它科系
            {
                
                $this->redirect(array('site/otherdepartment'));
            }

        }
        $this->render('friends');
    }

}