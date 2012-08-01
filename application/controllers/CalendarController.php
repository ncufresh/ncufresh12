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
        if ( Yii::app()->request->getIsAjaxRequest() )
        {
            if ( isset($_POST['calendar']) )
            {
                $id = (integer)$_POST['calendar']['id'];
                if ( Event::model()->show($id) ) return true;
            }
            $this->_data['errors'][] = '發生錯誤！';
            return true;
        }
    }

    public function actionSubscript()
    {
        if ( isset($_POST['token']) )
        {
            // 若checkbox完全沒有勾選擇給$_POST['subscript']一空陣列
            if( !isset($_POST['subscript']) ) $_POST['subscript'] = array();
            
            $subscript = new Subscription();
            
            $array = self::getPostKeys($_POST['subscript']);
            $check = 0;
            //新增訂閱
            if ( count(array_diff($array, self::getSubscribedCalendars()))!=0 )
            {
                foreach(array_diff($array, self::getSubscribedCalendars()) as $value)
                {
                    if ( Subscription::model()->getInvisibleSubscriptionByCalendarID($value) )
                    {
                        $subscript = Subscription::model()->getInvisibleSubscriptionByCalendarID($value);
                        $subscript->invisible = 0;
                        if ( ! $subscript->save() ) $check=1;
                        continue;
                    }
                    $subscript = new Subscription();
                    $subscript->calendar_id = $value;
                    $subscript->invisible = 0;
                    if ( ! $subscript->save() ) $check=1;
                }
            }
            
            //取消訂閱
            if ( count(array_diff(self::getSubscribedCalendars(), $array))!=0 )
            {
                foreach(array_diff(self::getSubscribedCalendars(), $array) as $value)
                {                    
                    if ( $subscript->getSubscriptionByCalendarID($value) )
                    {                        
                        $subscript = Subscription::model()->getSubscriptionByCalendarID($value);
                        $subscript->invisible = 1;
                        if ( ! $subscript->save() ) $check=1;
                    }
                }
            }
            
            if ( $check == 0 ) $this->redirect(Yii::app()->createUrl('calendar/view'));
        }
        $this->render('subscript', array(
            'clubs' => Calendar::model()->getClubs()
        ));
    }

    private function getPostKeys($post)
    {
        $array = array();
        $i =0;
        foreach( $post as $key => $value )
        {
            $array[$i++] = $key;
        }
        return $array;
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

    //測試完封閉一般REQUEST
    public function actionAjaxEvent($id)
    {
        $event = Event::model()->getEventById($id);
        $this->_data['event']['id'] = $event->id;
        $this->_data['event']['start'] = $event->start;
        $this->_data['event']['end'] = $event->end;
        $this->_data['event']['name'] = $event->name;
        $this->_data['event']['description'] = $event->description;
    }

    //測試完封閉一般REQUEST
    public function actionAjaxEvents()
    {
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
            $user = User::model()->findByPk(Yii::app()->user->id);
            $counter = 0;
            if( Yii::app()->user->isMember )
            {
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
                    foreach ( $calendar->events as $event )
                    {
                        $this->_data['events'][$counter]['id'] = $event->id;
                        $this->_data['events'][$counter]['start'] = $event->start;
                        $this->_data['events'][$counter]['name'] = $event->name;
                        $this->_data['events'][$counter]['end'] = $event->end;
                        $counter++;
                    }
                }
            }
            else
            {
                $events = Calendar::model()->getGeneralCalendar()->events;
                foreach ( $events as $key => $event )
                {
                    $this->_data['events'][$key]['id'] = $event->id;
                    $this->_data['events'][$key]['start'] = $event->start;
                    $this->_data['events'][$key]['name'] = $event->name;
                    $this->_data['events'][$key]['end'] = $event->end;
                }
            }
        }
    }
}