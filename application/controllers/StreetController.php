<?php

class StreetController extends Controller
{
    public function actionIndex() // main page
    {
        $this->render('index');
	}

	public function actionBuilding($id = 0) // dialog building information page
    { 
        // $url = Yii::app()->baseUrl.'/statics/building';
        $url = Yii::app()->baseUrl.'/statics/building';
        switch($id)
        {
            case 1 :
            //                                               檔名                          data 回傳 not echo on screen
            $this->_data['content'] = $this->renderPartial('department-building/content1', null, true, false);            
            $this->_data['picture_main'] = $url.'/college/555.png';                        
            $this->_data['picture_other_1'] = $url.'/college/555.png';                        
            $this->_data['picture_other_2'] = $url.'/college/555.png';                        
            break;        
            case 2 :
            $this->_data['content'] = $this->renderPartial('department-building/content2', null, true, false);
            $this->_data['picture_main'] = $url.'/college/111.png';                        
            $this->_data['picture_other_1'] = $url.'/college/111.png';                        
            $this->_data['picture_other_2'] = $url.'/college/111.png';    
            break;
            case 3:
            $this->_data['content'] = $this->renderPartial('department-building/content3', null, true, false);
            break;
        }
    }

    public function actionStreet() // 街景服務頁
    {
    }
}
?>
