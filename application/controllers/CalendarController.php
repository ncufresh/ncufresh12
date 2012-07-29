<?php

class CalendarController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array();
    }

    public function actionView()
    {
        $this->render('view');
    }

    public function actionClub()
    {
    }

    public function actionRecycle()
    {
    }

    public function actionEventDetail()
    {
    }
    
    public function actionCreateEvent()
    {
    }

    public function actionHideEvent()
    {
    }

    public function actionShowEvent()
    {
    }

    public function actionDeleteEvent()
    {
    }

    public function actionSubscript()
    {
    }

    public function actionUnsubsciprt()
    {
        
    }

    public function actionAjaxEvent($id)
    {
        $event = Event::model()->getEventById($id);
        $this->_data['event']['id'] = $event->id;
        $this->_data['event']['start'] = $event->start;
        $this->_data['event']['end'] = $event->end;
    }

    public function actionAjaxEvents()
    {
        $this->_data['events'] = array();
        $user = User::model()->findByPk(Yii::app()->user->id);
        foreach ( $user->calendar->events as $key => $event )
        {
            $this->_data['events'][$key]['id'] = $event->id;
            $this->_data['events'][$key]['start'] = $event->start;
            $this->_data['events'][$key]['end'] = $event->end;
        }
    }
}