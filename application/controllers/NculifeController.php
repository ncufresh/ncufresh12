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
                $this->_data['image'] = $this->renderPartial('health/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('health/2', null, true, false);
                $this->_data['image'] = $this->renderPartial('health/2', null, true, false);
                break;
            default:
                $this->_data['content'] = $this->renderPartial('health/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('health/1', null, true, false);
                break;
        }
    }

    public function live($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('live/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('live/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('live/2', null, true, false);
                break;
        }
    }

    public function traffic($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('traffic/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('traffic/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('traffic/2', null, true, false);
                break;
        }
    }

    public function play($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('play/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('play/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('play/2', null, true, false);
                break;
        }
    }

    public function school($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('school/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('school/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('school/2', null, true, false);
                break;
        }
    }
}