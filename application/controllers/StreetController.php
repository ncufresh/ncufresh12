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
        $url2;
        if( 1 <= $id && $id <= 16 )
        {
            $url2 = 'department-building';
        }
        else if( ( 17 <= $id && $id <= 26 ) || $id == 61 || $id == 62 || $id == 63 )
        {
            $url2 = 'landscape';
        }
        else if( ( 27 <= $id && $id <= 33 ) || $id == 68 )
        {
            $url2 = 'diet';
        }
        else if( $id <= 37 || $id == 64 || $id == 65 || $id == 66 || $id == 67 )
        {
            $url2 = 'government';
        }
        else if( $id <= 51 )
        {
            $url2 = 'dormitory';
        }
        else
        {
            $url2 = 'exercise';
        }

        $this->_data['content'] = $this->renderPartial( $url2 . '/content' . $id, null, true, false);
        // $this->_data['photo'] = $url . '/' . $id . '-big.jpg';
        // $this->_data['picture_main'] = $url . '/' . $id . '.png';
        // $this->_data['picture_other'][0] = $url . '/' . $id . '.png';                
        // $this->_data['picture_other'][1] = $url . '/' . $id . '.png';
        // $this->_data['pictureLayerTwo'][0] = $url . '/5.png';
        // $this->_data['pictureLayerTwo'][1] = $url . '/4.png';
        // $this->_data['pictureLayerTwo'][2] = $url . '/1.png';
    }
}