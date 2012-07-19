<?php

class StreetController extends Controller
{
  
    public function actionIndex() // 綜視圖主頁
    {
        $sss='111';
        $this->render('index',array('test'=>$sss)); 
    }

    public function actionPicture() // 跳出介紹文字頁
    {
    }

    public function actionStreet() // 街景服務頁
    {
    }
}