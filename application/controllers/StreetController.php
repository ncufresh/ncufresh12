<?php

class StreetController extends Controller
{
  
    public function actionIndex() // ����ϥD��
    {
        $sss='111';
        $this->render('index',array('test'=>$sss)); 
    }

    public function actionPicture() // ���X���Ф�r��
    {
    }

    public function actionStreet() // �󴺪A�ȭ�
    {
    }
}