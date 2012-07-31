<?php

class StreetController extends Controller
{
    protected $_path;

    public function init()
    {
        $this->_path =  Yii::app()->baseUrl . '/statics';
    }

    private function loadFiles($directory)
    {
        $files = array();
        if ( is_dir($directory) ) // directory 是資料夾
        {
            $dir = dir($directory);
            while ( $entry = $dir->read() )
            {
                if ( $entry != '.' && $entry != '..' ) // 不是上一層及上上一層 
                {
                    $files[$entry] = Yii::app()->baseUrl . '/' . $dir->path . '/' . $entry;
                }
            }
        }
        return $files;
    }

    public function actionIndex() // main page
    {
        $files = $this->loadFiles('statics/building/pictureLayerTwo');
        $this->render('index' , array(
            'files'           => $files 
        ));
	}

	public function actionBuilding($id = 0) // dialog building information page
    {
        $url = $this->_path . '/building';

        // Is the condition correct?
        // if ( 1 <= $id && $id <= 16 )
        // {
            // $url .= '/college';
        // }
        // else if ( 17 <= $id && $id <= 27 )
        // {
            // $url .= '/landscape';
        // }
        // else if ( 28 <= $id && $id <= 33 )
        // {
            // $url .= '/food';
        // }
        // else if ( 34 <= $id && $id <= 38 )
        // {
            // $url .= '/government';
        // }
        // else if ( 39 <= $id && $id <= 51 )
        // {
            // $url .= '/dormitory';
        // }
        // else
        // {
            // $url .= '/exercise';
        // }

        $this->_data['content'] = $this->renderPartial('department-building/content' . $id, null, true, false);
        $this->_data['photo'] = $url . '/' . $id . '-big.jpg';
        $this->_data['picture_main'] = $url . '/' . $id . '.png';
        $this->_data['picture_other'][0] = $url . '/' . $id . '.png';                
        $this->_data['picture_other'][1] = $url . '/' . $id . '.png';
        $this->_data['pictureLayerTwo'][0] = $url . '/5.png';
        $this->_data['pictureLayerTwo'][1] = $url . '/4.png';
        $this->_data['pictureLayerTwo'][2] = $url . '/1.png';
    }
}