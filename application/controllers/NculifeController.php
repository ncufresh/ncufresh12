<?php
    
class NculifeController extends Controller
{
    public function actionIndex()
    {
         $this->render('index');
        /* $this->renderPartial('index'); */
    }

    public function actionLive()
    {
        $this->render('live');
    }
    
    public function actionContent($page, $tab)
    {
        switch( strtolower($page) )
        {
            case 'food' :
                $this->food($tab);
                break;
            case 'live' :
                $this->live($tab);
                break;
            case 'house' :
                $this->house($tab);
                break;
            case 'sport' :
                $this->sport($tab);
                break;
            case 'health' :
                $this->health($tab);
                break;
            case 'car' :
                $this->car($tab);
                break;
            case 'outside' :
                $this->outside($tab);
                break;
        }
    }

    public function actionLiveContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('livecontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('livecontent/2', null, true, false);
                break;
        }
    }

/*     public function food($tab)
    {
        $this->render('food');
    }
 */
    public function food($tab)
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

    public function actionHouse()
    {
        $this->render('house');
    }

    public function actionHouseContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('housecontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('housecontent/2', null, true, false);
                break;
        }
    }

    public function actionCar()
    {
         $this->render('car');
        /* $this->renderPartial('car'); */
    }

    public function actionCarContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('carcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('carcontent/2', null, true, false);
                break;
        }
    }

    public function actionOutside()
    {
        $this->render('outside');
    }

    public function actionOutsideContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('outsidecontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('outsidecontent/2', null, true, false);
                break;
        }
    }

    public function actionSport()
    {
        $this->render('sport');
    }

    public function actionSportContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('sportcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('sportcontent/2', null, true, false);
                break;
        }
    }

    public function actionHealth()
    {
        $this->render('health');
    }

    public function actionHealthContent($tab_id)
    {
        switch ( $tab_id )
        {
            case 1 : 
                $this->_data['content'] = $this->renderPartial('healthcontent/1', null, true, false);
                break;
            case 2 :
                $this->_data['content'] = $this->renderPartial('healthcontent/2', null, true, false);
                break;
        }
    }
}