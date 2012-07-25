<?php

class StreetController extends Controller
{
    protected $_path;

    public function init()
    {
        $this->_path =  Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'statics';
    }

    public function actionIndex() // main page
    {
        $this->render('index');
	}

	public function actionBuilding($id = 0) // dialog building information page
    {
        $url = $this->_path . DIRECTORY_SEPARATOR . 'building';
        switch ( $id )
        {
            case 1 :
                $url .= DIRECTORY_SEPARATOR . 'college';
                $this->_data['content'] = $this->renderPartial('department-building/content1', null, true, false);
                $this->_data['picture_main'] = $url . DIRECTORY_SEPARATOR . '555.png';
                $this->_data['picture_other_1'] = $url . DIRECTORY_SEPARATOR . '555.png';
                $this->_data['picture_other_2'] = $url . DIRECTORY_SEPARATOR . '555.png';
                break;
            case 2 :
                $url .= DIRECTORY_SEPARATOR . 'college';
                $this->_data['content'] = $this->renderPartial('department-building/content2', null, true, false);
                $this->_data['picture_main'] = $url . DIRECTORY_SEPARATOR . '111.png';
                $this->_data['picture_other_1'] = $url . DIRECTORY_SEPARATOR . '111.png';
                $this->_data['picture_other_2'] = $url . DIRECTORY_SEPARATOR . '111.png';
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