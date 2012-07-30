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
        if ( Yii::app()->request->getIsAjaxRequest() )
        {
            if ( isset($_POST['calendar']) )
            {
                $id = (integer)$_POST['calendar']['id'];
                $event = Event::model()->findByPk($id);
                $event->invisible = true;
                if ( $event->save() ) return true;
            }
            $this->_data['errors'][] = '發生錯誤！';
            return true;
        }

        $this->render('recycle', array(
            'events'    => Event::model()->getRecycledEvents()
        ));
    }

    public function actionEventDetail()
    {
    }
    
    public function actionCreateEvent()
    {
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
                if ( $event->calendar->getIsPersonal() )
                {
                    $this->_data['events'][$key]['category'] = 'PERSONAL';
                }
                else if ( $event->calendar->getIsClub() )
                {
                    $this->_data['events'][$key]['category'] = 'CLUB';
                }
                else
                {
                    $this->_data['events'][$key]['category'] = 'GENERAL';
                }
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