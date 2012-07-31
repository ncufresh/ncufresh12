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
        foreach ( Calendar::model()->getClubs() as $qq )
        {
            var_dump($qq->id);
            var_dump($qq->clubs->name);
            var_dump($qq->subscriptions ? 1 : 0);
        }
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

    public function actionEvent($id)
    {
        $id = (integer)$id;
        $event = Event::model()->getEventById($id);
        if( $event )
        {
            $this->render('event', array(
                'event' => $event
            ));
        }
        else
        {
            throw new CHttpException(404);
        }
    }
    
    public function actionCreateEvent()
    {
        $event = new Event();
        if ( isset($_POST['event']) )
        {
            $event->name = $_POST['event']['name'];
            $event->description = $_POST['event']['description'];
            $event->invisible = 0;
            $event->start = strtotime($_POST['event']['start']);
            $event->end = strtotime($_POST['event']['end']);
            $event->calendar_id = Calendar::Model()->find('user_id='.Yii::app()->user->getId().' AND category=1')->id;
            $event->save();
        }
        $this->render('create_event');
    }

    public function actionHideEvent()
    {
        if ( Yii::app()->request->getIsAjaxRequest() )
        {
            if ( isset($_POST['calendar']) )
            {
                $id = (integer)$_POST['calendar']['id'];
                if ( Event::model()->hide($id) ) return true;
            }
            $this->_data['errors'][] = '發生錯誤！';
            return true;
        }
    }

    public function actionShowEvent()
    {
    }

    public function actionDeleteEvent()
    {
    }

    public function actionSubscript()
    {
        $club_calendars = Calendar::Model()->findAll('category=0 AND id!=1');
        $subscripted_calendars = Subscription::Model()->findAll('user_id='.Yii::app()->user->getId().' AND invisible=0');
        
        $clubs_category = array();
        $clubs_name = array();
        $calendar_id = array();
        $check = array();
        
        foreach ( $club_calendars as $key => $each )
        {
            $clubs_category[$i] = Club::Model()->getClubByMasterId($each->user_id)->category;
            $clubs_name[$i] = Club::Model()->getClubByMasterId($each->user_id)->name;
            $calendar_id[$i] = $each->id;
            $check[$i] = 0;
            foreach($subscripted_calendars as $subscripted)
            {
                if($subscripted->calendar_id == $each->id)
                {
                    $check[$key] = 1;
                    break;
                }
                else
                {
                    $check[$key] = 0;
                }
            }
        }
        if(isset($_POST['subscript'])){
            for ( $i=0; $i<count($club_calendars); $i++ ){
                if( isset($_POST['subscript'][$i]) && $_POST['subscript'][$i] == 1 ){
                    $subscription = new Subscription();
                    $subscription->user_id = Yii::app()->user->getId();
                    $subscription->calendar_id = Calendar::Model()->getClubCalendarByUserId($i)->id;
                    $subscription->invisible = 0;
                    $subscription->save();
                }
            }
        }
        // for($i=0;$i<count($club_calendars);$i++)
            // echo $check[$i];
        // exit();
        /*
        calendar id
        club category
        club name
        IsChecked
        */
        $this->render('subscript', array(
            'clubs_category' => $clubs_category,
            'clubs_name' => $clubs_name,
            'calendar_id' => $calendar_id,
            'check' => $check,
        ));
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
                if ( $event->calendar->getIsPersonal() )
                {
                    $this->_data['events']['個人'][] = array(
                        'id'        => $event->id,
                        'start'     => $event->start,
                        'end'       => $event->end,
                        'name'      => $event->name
                    );
                }
                else if ( $event->calendar->getIsClub() )
                {
                    $this->_data['events'][$event->calendar->getClubName()][] = array(
                        'id'        => $event->id,
                        'start'     => $event->start,
                        'end'       => $event->end,
                        'name'      => $event->name
                    );
                }
                else
                {
                    $this->_data['events']['全校'][] = array(
                        'id'        => $event->id,
                        'start'     => $event->start,
                        'end'       => $event->end,
                        'name'      => $event->name
                    );
                }
                // $this->_data['events'][$key]['description'] = $event->description;
            }
            $this->_data['token'] = Yii::app()->security->getToken();
        }
        else
        {
            $counter = 0;
            foreach ( $user->calendar->events as $event )
            {
                $this->_data['events'][$counter]['id'] = $event->id;
                $this->_data['events'][$counter]['start'] = $event->start;
                $this->_data['events'][$counter]['name'] = $event->name;
                $this->_data['events'][$counter]['end'] = $event->end;
                $counter++;
            }
            foreach ( $user->subscriptions as $calendar )
            {
                foreach( $calendar->events as $event )
                {
                    $this->_data['events'][$counter]['id'] = $event->id;
                    $this->_data['events'][$counter]['start'] = $event->start;
                    $this->_data['events'][$counter]['name'] = $event->name;
                    $this->_data['events'][$counter]['end'] = $event->end;
                    $counter++;
                }
            }
        }
    }
}