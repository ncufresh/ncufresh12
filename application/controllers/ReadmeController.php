<?php
    
class ReadmeController extends Controller
{
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name . ' - 大一必讀');
        $this->render('index');
    }
    
    public function actionContent($page, $tab)
    {
        switch( strtolower($page) )
        {
            case 'freshman' :
                $this->freshman($tab);
                break;
            case 'reschool' :
                $this->reschool($tab);
                break;
            case 'notice' :
                $this->notice($tab);
                break;
        }
    }

    public function freshman($tab)
    {
        switch ( $tab )
        {
            case 1 :
                $this->_data['content'] = $this->renderPartial('freshman/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('freshman/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('freshman/3', null, true, false);
                break;
        }
    }
    
    public function reschool($tab)
    {
        switch ( $tab )
        {
            case 1 :
                $this->_data['content'] = $this->renderPartial('reschool/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('reschool/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('reschool/3', null, true, false);
                break;
        }
    }
    
    public function notice($tab)
    {
        switch ( $tab )
        {
            case 1 :
                $this->_data['content'] = $this->renderPartial('notice/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('notice/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('notice/3', null, true, false);
                break;
        }
    }
    
    public function actionFreshman($id = 0)
    {
        $content = "沙小";
        
        if($id == 1)
        {
            $content = "健檢檢測";
            $index = array("可惡","機車", "水唷");
            $tab = array(1,2,3);
            $size = 3;
        }
        else if($id == 2)
        {
            $content = "健康體檢";
            $index = array("水唷", "機車", "可惡");
            $tab = array(4,5,6);
            $size = 3;
        }
        
        $this->setPageTitle(Yii::app()->name . ' - 新生區');
        $this->render('freshman',array(
            'content'        => $content ,
            'index'         => $index,
            'tab'           => $tab,
            'size'          => $size   
                                         ));
    }

    public function actionReschool()
    {
        $this->setPageTitle(Yii::app()->name . ' - 復學區');
        $this->render('reschool');
    }

    public function actionNotice()
    {
        $this->setPageTitle(Yii::app()->name . ' - 注意事項');
        $this->render('notice');
    }

    public function actionDownload()
    {
        $this->setPageTitle(Yii::app()->name . ' - 文件下載');
        $this->render('download');
    }
    
    
}