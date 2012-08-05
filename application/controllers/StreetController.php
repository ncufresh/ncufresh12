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
        $url;
        if( 1 <= $id && $id <= 16 )
        {
            $url = 'department-building';
        }
        else if( ( 17 <= $id && $id <= 26 ) || $id == 61 || $id == 62 || $id == 63 )
        {
            $url = 'landscape';
        }
        else if( ( 27 <= $id && $id <= 33 ) || $id == 68 )
        {
            $url = 'diet';
        }
        else if( $id <= 37 || $id == 64 || $id == 65 || $id == 66 || $id == 67 )
        {
            $url = 'government';
        }
        else if( $id <= 51 )
        {
            $url = 'dormitory';
        }
        else
        {
            $url = 'exercise';
        }

        $this->_data['content'] = $this->renderPartial( $url . '/content' . $id, null, true, false);
    }
}