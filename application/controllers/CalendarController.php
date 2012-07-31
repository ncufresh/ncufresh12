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
        // foreach ( Calendar::model()->getClubs() as $qq )
        // {
            // var_dump($qq->id);
            // var_dump($qq->clubs->name);
            // var_dump($qq->subscriptions ? 1 : 0);
        // }
        // var_dump(Event::model()->findByPk(1)->status)
        
        // var_dump( array_diff(array(
            // 10,2,3
        // ),array(
            // 2,3,4
        // )) );
    }

    public function actionRecycle()
    {
        if ( Yii::app()->request->getIsAjaxRequest() )
        {
            if ( isset($_POST['calendar']) )
            {
                $id = (integer)$_POST['calendar']['id'];
                $event = Event::model()->findByPk($id);
                if ( $event->calendar->getIsPersonal() && $event->calendar->getIsOwner() )
                {
                    $event->invisible = true;
                    if ( $event->save() ) return true;
                }
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
            if ( $event->save() )
            {
                $this->redirect(Yii::app()->createUrl('calendar/view'));
            }
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
        if ( isset($_POST['token']) )
        {
            if( !isset($_POST['subscript']) ) $_POST['subscript'] = array();
            echo '0';
            $subscript = new Subscription();
            $array = array();
            $i =0;
            foreach( $_POST['subscript'] as $key => $value)
            {
                $array[$i++] = $key;
            }
            
            //var_dump($array);
            //var_dump(self::getSubscribedCalendars());
            //var_dump(array_diff($array, self::getSubscribedCalendars()));
            // var_dump(array_diff(self::getSubscribedCalendars(), $array));
            // exit();
            //here
            
            //新傳入的值比原有的多出 => 新增訂閱
            if ( count(array_diff($array, self::getSubscribedCalendars()))!=0 )
            {
                echo '1';
                foreach(array_diff($array, self::getSubscribedCalendars()) as $value)
                {
                    if ( Subscription::Model()->find('calendar_id='.$value.' AND invisible=1 AND user_id='.Yii::app()->user->getId()) )
                    {
                        $subscript = Subscription::model()->find('calendar_id='.$value.' AND invisible = 1 AND user_id='.Yii::app()->user->getId());
                        $subscript->invisible = 0;
                        $subscript->save();
                        continue;
                    }
                    $subscript = new Subscription();
                    $subscript->calendar_id = $value;
                    $subscript->invisible = 0;
                    if ( $subscript->save() ) $this->redirect(Yii::app()->createUrl('calendar/view'));
                }
            }
            
            //原有的比新傳入多出的部分 => 取消訂閱
            if ( count(array_diff(self::getSubscribedCalendars(), $array))!=0 )
            {
                echo '2';
                var_dump(array_diff(self::getSubscribedCalendars(), $array));
                echo '<br/>';
                foreach(array_diff(self::getSubscribedCalendars(), $array) as $value)
                {
                    echo 'abc ';
                    // var_dump(self::getSubscribedCalendars());
                    // echo '<br/>';
                    // var_dump($array);
                    // echo '<br/>';
                    // var_dump(array_diff(self::getSubscribedCalendars(), $array));
                    
                    if ( $subscript->find('calendar_id='.$value.' AND invisible = 0 AND user_id='.Yii::app()->user->getId()) )
                    {
                        echo $subscript->find('calendar_id='.$value.' AND invisible = 0 AND user_id='.Yii::app()->user->getId())->calendar_id;
                        
                        $subscript = Subscription::model()->find('calendar_id='.$value.' AND invisible = 0 AND user_id='.Yii::app()->user->getId());
                        $subscript->invisible = 1;
                        if ( $subscript->save() ) $this->redirect(Yii::app()->createUrl('calendar/view'));
                    }
                    
                    // echo '<br/><br/>';
                }
            }
        }
        $this->render('subscript', array(
            'clubs' => Calendar::model()->getClubs()
        ));
    }

    private function getSubscribedCalendars()
    {
        $subscript = new Subscription();
        $subscribed_calendar_id = $subscript->getSubscribedCalendars();
        $result = array();
        $i = 0;
        foreach( $subscribed_calendar_id as $each )
        {
            $result[$i++] = $each->calendar_id;
        }
        return $result;
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