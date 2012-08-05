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
		if ( Yii::app()->request->getIsAjaxRequest() )
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
			return true;
		}
		throw new CHttpException(404);
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
            case 4 :
                $this->_data['content'] = $this->renderPartial('freshman/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('freshman/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('freshman/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('freshman/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('freshman/8', null, true, false);
                break;
            case 9 :
                $this->_data['content'] = $this->renderPartial('freshman/9', null, true, false);
                break;
            case 10 :
                $this->_data['content'] = $this->renderPartial('freshman/10', null, true, false);
                break;
            case 12 :
                $this->_data['content'] = $this->renderPartial('freshman/12', null, true, false);
                break;
            case 13 :
                $this->_data['content'] = $this->renderPartial('freshman/13', null, true, false);
                break;
            case 14 :
                $this->_data['content'] = $this->renderPartial('freshman/14', null, true, false);
                break;
            case 15 :
                $this->_data['content'] = $this->renderPartial('freshman/15', null, true, false);
                break;
            case 16 :
                $this->_data['content'] = $this->renderPartial('freshman/16', null, true, false);
                break;
            case 17 :
                $this->_data['content'] = $this->renderPartial('freshman/17', null, true, false);
                break;
            case 18 :
                $this->_data['content'] = $this->renderPartial('freshman/18', null, true, false);
                break;
            case 19 :
                $this->_data['content'] = $this->renderPartial('freshman/19', null, true, false);
                break;
            case 20 :
                $this->_data['content'] = $this->renderPartial('freshman/20', null, true, false);
                break;
            case 21 :
                $this->_data['content'] = $this->renderPartial('freshman/21', null, true, false);
                break;
            case 22 :
                $this->_data['content'] = $this->renderPartial('freshman/22', null, true, false);
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
            case 4 :
                $this->_data['content'] = $this->renderPartial('reschool/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('reschool/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('reschool/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('reschool/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('reschool/8', null, true, false);
                break;
            case 9 :
                $this->_data['content'] = $this->renderPartial('reschool/9', null, true, false);
                break;
            case 10 :
                $this->_data['content'] = $this->renderPartial('reschool/10', null, true, false);
                break;
            case 11 :
                $this->_data['content'] = $this->renderPartial('reschool/11', null, true, false);
                break;
            case 12 :
                $this->_data['content'] = $this->renderPartial('reschool/12', null, true, false);
                break;
            case 13 :
                $this->_data['content'] = $this->renderPartial('reschool/13', null, true, false);
                break;
            case 14 :
                $this->_data['content'] = $this->renderPartial('reschool/14', null, true, false);
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
            case 4 :
                $this->_data['content'] = $this->renderPartial('notice/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('notice/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('notice/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('notice/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('notice/8', null, true, false);
                break;
            case 9 :
                $this->_data['content'] = $this->renderPartial('notice/9', null, true, false);
                break;
            case 10 :
                $this->_data['content'] = $this->renderPartial('notice/10', null, true, false);
                break;
            case 11 :
                $this->_data['content'] = $this->renderPartial('notice/11', null, true, false);
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
                '導師輔導資源系統',
                '新生校園安全須知',
            );
            $tab = array(4, 5, 6, 7, 8, 21);
            $size = 6;
        }

        else if ( $id == 3 )
        {
            $index = array(
                '註冊開學',
                '繳交學雜費',
                '學籍登入',
                '大一新生宿舍',
                '2012中大新生營',
            );
            $tab = array(9, 10, 12, 13, 14);
            $size = 5;
        }

        else if ( $id == 4 )
        {
            $index = array(
                '大一生活宿舍注意事項',
                '男生兵役注意事項',
                '學雜費減免',
                '選課',
                '新生大一英文修課規定',
                '申請就學貸款須知',
				'新生大一國文修課規定'
            );
            $tab = array(15, 16, 17, 18, 19, 20, 22);
            $size = 7;
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
            $index = array(
                '健康檢查流程及注意事項',
                '大一國文寫作檢定',
                '僑生大一中文能力分級測驗'
            );
            $tab = array(1, 2, 3);
            $size = 3;
        }

        else if( $id == 2 )
        {
            $index = array(
                '新生輔導需求調查',
                '導師輔導資源系統'
            );
            $tab = array(4, 5);
            $size = 2;
        }

        else if( $id == 3 )
        {
            $index = array(
                '註冊開學',
                '線上登錄學籍',
                '繳交學雜費',
                '2012中大新生營'
            );
            $tab = array(6, 7, 8, 9);
            $size = 4;
        }

        else if( $id == 4 )
        {
            $index = array(
                '男生兵役注意事項',
                '宿舍申請辦法',
                '復學生大一英文修課規定',
                '申請學雜費減免',
                '申請就學貸款須知',
            );
            $tab = array(10, 11, 12, 13, 14);
            $size = 5;
        }
        $this->setPageTitle(Yii::app()->name . ' - 復學區');
        $this->render('reschool', array(
                'index'         => $index,
                'tab'           => $tab,
                'size'          => $size
        ));
    }

    public function actionNotice($id = 0)
    {
        if( $id == 1 )
        {
            $index = array(
                '大學和高中導師大不同',
                '學生學習講座',
                '學生學習護照實施流程',
                '家長座談會',
                '導師輔導選課',
                '性別平等',
                '新生汽機車入校須知',
                '服務學習',
                '校安中心聯絡電話',
                '種子,志工團隊',
                '網路學習資源'
            );
            $tab = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
            $size = 11;
        }
        $this->setPageTitle(Yii::app()->name . ' - 注意事項');
        $this->render('notice', array(
                'index'         => $index,
                'tab'           => $tab,
                'size'          => $size
        ));
    }

    public function actionDownload()
    {
        $this->setPageTitle(Yii::app()->name . ' - 文件下載');
        $this->render('download');
    }
}