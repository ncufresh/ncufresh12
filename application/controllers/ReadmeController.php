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
        if ( $id == 1 )
        {
            $index = array(
                '新生體檢說明項目及流程',
                '大一新生國文檢定',
                '僑生大一中文能力分級檢測'
            );
            $tab = array(1, 2, 3);
            $size = 3;
        }
        else if ( $id == 2 )
        {
            $index = array(
                '大一新生身心適應心理講座',
                '新生入學輔導',
                '學生學習協助與輔導',
                '新生輔導需求調查',
                '導師輔導資源系統'
            );
            $tab = array(4, 5, 6, 7, 8);
            $size = 5;
        }

        else if ( $id == 3 )
        {
            $index = array(
                '註冊開學',
                '繳交學雜費',
                '註冊日程',
                '學籍登入',
                '大一新生宿舍',
                '2012中大新生宿舍',
            );
            $tab = array(9, 10, 11, 12, 13, 14);
            $size = 6;
        }
        
        else if( $id == 4 )
        {
            $index = array('GO唷', '機車', '可惡');
            $tab = array(10,11,12);
            $size = 3;
        }

        $this->setPageTitle(Yii::app()->name . ' - 新生區');
        $this->render('freshman', array(
                'index'         => $index,
                'tab'           => $tab,
                'size'          => $size
        ));
    }

    public function actionReschool($id = 0)
    {
        if( $id == 1 )
        {
            $index = array('我要','復學', '水唷');
            $tab = array(1,2,3);
            $size = 3;
        }
        else if( $id == 2 )
        {
            $index = array('水唷', '機車', '可惡');
            $tab = array(4,5,6);
            $size = 3;
        }
        
        else if( $id == 3 )
        {
            $index = array('棒唷', '機車', '可惡');
            $tab = array(7,8,9);
            $size = 3;
        }
        
        else if( $id == 4 )
        {
            $index = array('GO唷', '機車', '可惡');
            $tab = array(10,11,12);
            $size = 3;
        }
        $this->setPageTitle(Yii::app()->name . ' - 復學區');
        $this->render('reschool', array(
                'index'         => $index,
                'tab'           => $tab,
                'size'          => $size
        ));
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