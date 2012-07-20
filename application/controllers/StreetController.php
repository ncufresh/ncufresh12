<?php        
class  StreetController extends Controller
{
    public function actionIndex() // main page
    {   
        $this->render('index');
	}

	public function actionBuilding($id = 0) // dialog building information page
    {
        $picture = array();       
        $content = array();
        $content[1]='額額額額額額額額額額額額額額額額額額額額額';
        $content[2]='嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚';
        $this->_data['content'] = $content[$id];       
        $this->_data['id'] = $id;       
    }
    
    public function actionStreet() // 街景服務頁
    {
    }      
}
?>

       
