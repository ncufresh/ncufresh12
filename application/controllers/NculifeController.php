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
                $this->food($tab);
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

    public function health()
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('healthcontent/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('healthcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('healthcontent/2', null, true, false);
                $this->_data['image'] = $this->renderPartial('healthcontent/2', null, true, false);
                break;
        }
    }

    public function live($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('foodcontent/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('foodcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('foodcontent/2', null, true, false);
                break;
        }
    }

    public function traffic($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('foodcontent/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('foodcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('foodcontent/2', null, true, false);
                break;
        }
    }

    public function play($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('foodcontent/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('foodcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('foodcontent/2', null, true, false);
                break;
        }
    }

    public function school($tab)
    {
        switch ( $tab )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('foodcontent/1', null, true, false);
                $this->_data['image'] = $this->renderPartial('foodcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('foodcontent/2', null, true, false);
                break;
        }
    }
}