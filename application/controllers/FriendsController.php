<?php

class FriendsController extends Controller
{

    public function actionFriends() // 好友專區
    {
        echo "齁齁齁";
        if ( isset($_GET['id']) )
        {
            echo "進來了^^";
            $id = (integer)$_GET['id'];
            if ( $id === 1 ) // 同系同屆 
            {
                $this->redirect(array('friends/samedepartment_samegrade'));
            }
            else if ( $id === 2 ) // 同系不同屆
            {
                $this->redirect(array('friends/samedepartment_diffgrade'));
            }
            else if ($id === 3 ) // 其它科系
            {
                $this->redirect(array('friends/otherdepartment'));
            }
        }
        $this->render('friends');
    }
}