<?php

class StreetController extends Controller
{
    protected $_path;

    public function init()
    {
        $this->_path =  Yii::app()->baseUrl . '/statics';
    }

    public function actionIndex() // main page
    {
        $this->render('index');
	}

	public function actionBuilding($id = 0) // dialog building information page
    {
        $url = $this->_path . '/building';
        switch ( $id )
        {
            case 1 :
                $url .= '/college';
                $this->_data['content'] = $this->renderPartial('department-building/content1', null, true, false);
                $this->_data['photo']=$url . '/555-big.png';
                $this->_data['picture_main'] = $url . '/555.png';
                $this->_data['picture_other'][0] = $url . '/555.png';
                $this->_data['picture_other'][1] = $url . '/555.png';
                
                //http://www.inote.tw/2009/04/php_13.html
                //讀取資料夾內所有資料
                $this->_data['pictureLayerTwo'][0] = $url . '/555.png';
                $this->_data['pictureLayerTwo'][1] = $url . '/444.png';
                $this->_data['pictureLayerTwo'][2] = $url . '/111.png';
                break;
            case 2 :
                $url .= '/college';
                $this->_data['content'] = $this->renderPartial('department-building/content2', null, true, false);
                $this->_data['photo']=$url . '/444-big.png';
                $this->_data['picture_main'] = $url . '/444.png';
                $this->_data['picture_other_1'] = $url . '/444.png';
                $this->_data['picture_other_2'] = $url . '/444.png';
                break;
            case 3:
                $this->_data['content'] = $this->renderPartial('department-building/content3', null, true, false);
                $this->_data['photo']=$url . '/111-big.png';
                $this->_data['picture_main'] = $url . '/111.png';
                $this->_data['picture_other_1'] = $url . '/111.png';
                $this->_data['picture_other_2'] = $url . '/111.png';
                break;
        }
    }

    public function actionStreet() // 街景服務頁
    {
    }
}