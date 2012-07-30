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
        $this->render('recycle');
    }

    public function actionEventDetail()
    {
    }
    
    public function actionCreateEvent()
    {
        $event = new Event();
        if ( isset($_POST['event']) )
        {
            $event->name = $_POST['event']['name'];
            $event->description = $_POST['event']['description'];
            $event->visible = 1;
            //user
            if(!Club::Model()->getIsAdmin(Yii::app()->user->getId()))
                $event->calendar_id = $event->getCalendarId(Yii::app()->user->getId(), 1);
            //club
            else  
                $event->calendar_id = $event->getCalendarId(Yii::app()->user->getId(), 0);
            $event->save();
            $this->redirect($event->url);
        }
        $this->render('create_event');
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
        $this->render('subscript');
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
        $this->_data['event']['name'] = $event->name;
        $this->_data['event']['description'] = $event->description;
    }

    public function actionAjaxEvents()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->_data['events'] = array();
        if( isset($_POST['event_ids']) )
        {
            $events = Event::model()->getEventsByIds($_POST['event_ids']);
            foreach( $events as $key => $event )
            {
                $this->_data['events'][$key]['id'] = $event->id;
                $this->_data['events'][$key]['category'] = $event->calendar->category;
                $this->_data['events'][$key]['start'] = $event->start;
                $this->_data['events'][$key]['end'] = $event->end;
                $this->_data['events'][$key]['name'] = $event->name;
                $this->_data['events'][$key]['description'] = $event->description;
            }
            $this->_data['token'] = Yii::app()->security->getToken();
        }
        else
        {
            foreach ( $user->calendar->events as $key => $event )
            {
                $this->_data['events'][$key]['id'] = $event->id;
                $this->_data['events'][$key]['start'] = $event->start;
                $this->_data['events'][$key]['end'] = $event->end;
            }
        }
    }
}