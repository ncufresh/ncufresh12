<?php
    
class NculifeController extends Controller
{
    public function actionIndex()
    {
         $this->render('index');
    }

    public function actionContent($page, $tab)
    {
        switch( strtolower($page) )
        {
            case 'health' :
                $this->health($tab);
                break;
            case 'live' :
                $this->live($tab);
                break;
            case 'traffic' :
                $this->house($tab);
                break;
            case 'play' :
                $this->sport($tab);
                break;
            case 'shool' :
                $this->health($tab);
                break;
        }
    }

    public function health($tab)
    {
        switch ( $tab )
        {
            case 1 :
                $this->_data['content'] = $this->renderPartial('health/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('health/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('health/3', null, true, false);
                break;
        }
    }

    public function live($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('live/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('live/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('live/3', null, true, false);
                break;
            case 4 :
                $this->_data['content'] = $this->renderPartial('live/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('live/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('live/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('live/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('live/8', null, true, false);
                break;
            case 9 :
                $this->_data['content'] = $this->renderPartial('live/9', null, true, false);
                break;
            case 10 :
                $this->_data['content'] = $this->renderPartial('live/10', null, true, false);
                break;
            case 11 :
                $this->_data['content'] = $this->renderPartial('live/11', null, true, false);
                break;
        }
    }

    public function traffic($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('traffic/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('traffic/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('traffic/3', null, true, false);
                break;
            case 4 :
                $this->_data['content'] = $this->renderPartial('traffic/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('traffic/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('traffic/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('traffic/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('traffic/8', null, true, false);
                break;
        }
    }

    public function play($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('play/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('play/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('play/3', null, true, false);
                break;
            case 4 :
                $this->_data['content'] = $this->renderPartial('play/4', null, true, false);
                break;
        }
    }

    public function school($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('school/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('school/2', null, true, false);
                break;
            case 3 :
                $this->_data['content'] = $this->renderPartial('school/3', null, true, false);
                break;
            case 4 :
                $this->_data['content'] = $this->renderPartial('school/4', null, true, false);
                break;
            case 5 :
                $this->_data['content'] = $this->renderPartial('school/5', null, true, false);
                break;
            case 6 :
                $this->_data['content'] = $this->renderPartial('school/6', null, true, false);
                break;
            case 7 :
                $this->_data['content'] = $this->renderPartial('school/7', null, true, false);
                break;
            case 8 :
                $this->_data['content'] = $this->renderPartial('school/8', null, true, false);
                break;
            case 9 :
                $this->_data['content'] = $this->renderPartial('school/9', null, true, false);
                break;
            case 10 :
                $this->_data['content'] = $this->renderPartial('school/10', null, true, false);
                break;
            case 11 :
                $this->_data['content'] = $this->renderPartial('school/11', null, true, false);
                break;
            case 12 :
                $this->_data['content'] = $this->renderPartial('school/12', null, true, false);
                break;
            case 13 :
                $this->_data['content'] = $this->renderPartial('school/13', null, true, false);
                break;
            case 14 :
                $this->_data['content'] = $this->renderPartial('school/14', null, true, false);
                break;
            case 15 :
                $this->_data['content'] = $this->renderPartial('school/15', null, true, false);
                break;
            case 16 :
                $this->_data['content'] = $this->renderPartial('school/16', null, true, false);
                break;
            case 17 :
                $this->_data['content'] = $this->renderPartial('school/17', null, true, false);
                break;
            case 18 :
                $this->_data['content'] = $this->renderPartial('school/18', null, true, false);
                break;
            case 19 :
                $this->_data['content'] = $this->renderPartial('school/19', null, true, false);
                break;
            case 20 :
                $this->_data['content'] = $this->renderPartial('school/20', null, true, false);
                break;
            case 21 :
                $this->_data['content'] = $this->renderPartial('school/21', null, true, false);
                break;
            case 22 :
                $this->_data['content'] = $this->renderPartial('school/22', null, true, false);
                break;
        }
    }
}