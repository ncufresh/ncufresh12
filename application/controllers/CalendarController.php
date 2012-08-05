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
        return array(
            array(
                'allow',
                'actions'   => array(
                    'view',
                    'recycle',
                    'event',
                    'createEvent',
                    'hideEvent',
                    'showEvent',
                    'subscript',
                    'club',
                    'clubRecycle',
                    'createClubEvent',
                    'subscriptfromclub',
                    'cancelsubscriptfromclub',
                ),
                'roles'     => array('member')
            ),
            array(
                'allow',
                'actions'   => array(
                    'ajaxEvent',
                    'ajaxEvents',
                    'ajaxClubEvents'
                ),
                'users'     => array('*')
            ),
            array(
                'deny',
                'users'     => array('*')
            )
        );
    }

    
    public function actionView()
    {
        $this->setPageTitle(Yii::app()->name . ' - 個人行事曆');
        $this->render('view');
    }

    public function actionClub($id)
    {
        $id = (integer)$id;
        if ( Club::model()->getIsMaster($id) )
        {
            $this->setPageTitle(Yii::app()->name . ' - 社團行事曆');
            $this->render('club', array('id' => $id));
        }
        else
        {
            throw new CHttpException(404);
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
                if ( $event->calendar->getIsPersonal() && $event->calendar->getIsOwner() )
                {
                    $event->invisible = true;
                    if ( $event->save() ) return true;
                }
            }
            $this->_data['errors'][] = '發生錯誤！';
            $this->_data['errors'][] = $event->getErrors();
            return true;
        }

        $events = Event::model()->getRecycledEvents();
        $result = array();
        foreach ( $events as $event )
        {
            if ( $event->calendar->getIsGeneral() )
            {
                $result['全校'][] = $event;
            }
            else if ( $event->calendar->getIsClub() )
            {
                $name = $event->calendar->getClubName();
                $result[$name][] = $event;
            }
            else
            {
                $result['個人'][] = $event;
            }
        }

        $this->setPageTitle(Yii::app()->name . ' - 回收桶');
        $this->render('recycle', array(
            'result'    => $result
        ));
    }

    public function actionClubRecycle($id)
    {
        $id = (integer)$id;
        if ( Yii::app()->request->getIsAjaxRequest() 
            && Club::model()->getIsMaster($id) )
        {
            if ( isset($_POST['calendar']) )
            {
                $id = (integer)$_POST['calendar']['id'];
                $event = Event::model()->findByPk($id);
                if ( $event->calendar->getIsClub() && $event->calendar->getIsOwner() )
                {
                    $event->invisible = true;
                    if ( $event->save() ) return true;
                }
            }
            $this->_data['errors'][] = '發生錯誤！';
            return true;
        }
        throw new CHttpException(404);
    }

    public function actionEvent($id)
    {
        $id = (integer)$id;
        $event = Event::model()->getEventById($id);
        if( $event )
        {
            $this->setPageTitle(Yii::app()->name . ' - 查看事件');
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
            $event->start = $_POST['event']['start'];
            $event->end = $_POST['event']['end'];
            $event->calendar_id = Calendar::Model()->find('user_id='.Yii::app()->user->getId().' AND category=1')->id;
            if ( $event->validate() && $event->save() )
            {
                $this->redirect(Yii::app()->createUrl('calendar/view'));
            }
        }
        $this->setPageTitle(Yii::app()->name . ' - 新增事件');
        $this->render('create_event');
    }

    public function actionCreateClubEvent($id)
    {
        $id = (integer)$id;
        if ( ! Club::model()->getIsMaster($id) ) throw new CHttpException(404);
        $event = new Event();
        if ( isset($_POST['event']) )
        {
            $event->name = $_POST['event']['name'];
            $event->description = $_POST['event']['description'];
            $event->invisible = 0;
            $event->start = $_POST['event']['start'];
            $event->end = $_POST['event']['end'];
            $event->calendar_id = Calendar::Model()->find('user_id='.Yii::app()->user->getId().' AND category=0')->id;
            if ( $event->validate() && $event->save() )
            {
                $this->redirect(Yii::app()->createUrl('calendar/club', array('id'=>$id)));
            }
        }
        $this->setPageTitle(Yii::app()->name . ' - 新增社團事件');
        $this->render('create_club_event', array('id'=>$id));
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
        throw new CHttpException(404);
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
        throw new CHttpException(404);
    }

    public function actionSubscriptFromClub($club_id)
    {
        if ( Club::model()->findByPK($club_id) )
        {
            $subscription = new Subscription();
            $calendar_id = Club::model()->with(
                'calendar'
            )->findByPk($club_id)->calendar->id;
            $check = 0;
            if ( Subscription::model()->getInvisibleSubscriptionByCalendarID($calendar_id) )
            {
                $subscript = Subscription::model()->getInvisibleSubscriptionByCalendarID($calendar_id);
                $subscript->invisible = 0;
                if ( ! $subscript->save() ) $check=1;
            }
            else
            {
                $subscript = new Subscription();
                $subscript->calendar_id = $calendar_id;
                $subscript->invisible = 0;
                if ( ! $subscript->save() ) $check=1;
            }
            if ( $check == 0 )
            {
                $this->redirect(Yii::app()->createUrl('calendar/view'));
            }
            else
            {
                throw new CHttpException(404);
            }
        }
        else throw new CHttpException(404);
    }

    public function actionCancelSubscriptFromClub($club_id)
    {
        if ( Club::model()->findByPK($club_id) )
        {
            $subscription = new Subscription();
            $calendar_id = Club::model()->with(
                'calendar'
            )->findByPk($club_id)->calendar->id;
            $check = 0;
            if ( Subscription::model()->getSubscriptionByCalendarID($calendar_id) )
            {
                $subscript = Subscription::model()->getSubscriptionByCalendarID($calendar_id);
                $subscript->invisible = 1;
                if ( ! $subscript->save() ) $check=1;
            }
            else
            {
                $subscript = new Subscription();
                $subscript->calendar_id = $calendar_id;
                $subscript->invisible = 1;
                if ( ! $subscript->save() ) $check=1;
            }
            if ( $check == 0 )
            {
                $this->redirect(Yii::app()->createUrl('club/content', array('id'=>$club_id)));
            }
            else
            {
                throw new CHttpException(404);
            }
        }
        else throw new CHttpException(404);
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
        
        $result = array();
        $calendars = Calendar::model()->getClubs();
        foreach ( $calendars as $calendar )
        {
            $result[$calendar->club->category][] = $calendar;
        }

        $this->setPageTitle(Yii::app()->name . ' - 訂閱行事曆');
        $this->render('subscript', array(
            'result' => $result
        ));
    }

    private function getPostKeys($post)
    {
        $array = array();
        $i = 0;
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

    public function actionAjaxEvent($id)
    {
        if ( ! Yii::app()->request->getIsAjaxRequest() ) throw new CHttpException(404);
        $id = (integer)$id;
        $event = Event::model()->getEventById($id);
        $this->_data['event']['id'] = $event->id;
        $this->_data['event']['start'] = $event->start;
        $this->_data['event']['end'] = $event->end;
        $this->_data['event']['name'] = $event->name;
        $this->_data['event']['description'] = $event->description;
    }

    public function actionAjaxEvents($club = false)
    {
        if ( ! Yii::app()->request->getIsAjaxRequest() ) throw new CHttpException(404);
        if ( $club ) return $this->getAjaxClubEvents();
        $this->_data['events'] = array();

        //有POST IDS
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
            }
            $this->_data['token'] = Yii::app()->security->getToken();
        }
        //抓取全部事件
        else if ( isset($_GET['m']) && isset($_GET['y']) )
        {
            $month = (integer)$_GET['m'] + 1;
            $year = (integer)$_GET['y'];
            $counter = 0;
            //登入
            if( Yii::app()->user->isMember )
            {
                $user = User::model()->findByPk(Yii::app()->user->id);
                //個人
                $calendar = $this->loadPersonalCalendar();
                $calendar = Calendar::model()->limitMonth($year, $month)->getPersonalCalendar();
                $events = $calendar?$calendar->events:array();
                foreach ( $events as $event )
                {
                    $this->_data['events'][$counter]['id'] = $event->id;
                    $this->_data['events'][$counter]['start'] = $event->start;
                    $this->_data['events'][$counter]['name'] = $event->name;
                    $this->_data['events'][$counter]['end'] = $event->end;
                    $counter++;
                }
                //訂閱
                $subscriptions = $user->subscriptions;
                foreach ( $subscriptions as $calendar )
                {
                    $events = Event::model()->limitMonth($year, $month)->getEventsByCalendarId($calendar->id);
                    foreach ( $events as $event )
                    {
                        $this->_data['events'][$counter]['id'] = $event->id;
                        $this->_data['events'][$counter]['start'] = $event->start;
                        $this->_data['events'][$counter]['name'] = $event->name;
                        $this->_data['events'][$counter]['end'] = $event->end;
                        $counter++;
                    }
                }
            }
            //未登入/全校
            // $events = Calendar::model()->getGeneralCalendar()->events;
            $g_calendar = Calendar::model()->limitMonth($year, $month)->getGeneralCalendar();
            $events = $g_calendar?$g_calendar->events:array();
            foreach ( $events as $key => $event )
            {
                $this->_data['events'][$counter]['id'] = $event->id;
                $this->_data['events'][$counter]['name'] = $event->name;
                $this->_data['events'][$counter]['start'] = $event->start;
                $this->_data['events'][$counter]['end'] = $event->end;
                $counter++;
            }
        }
    }

    public function actionAjaxClubEvents($id)
    {
        if ( isset($_GET['y'])&&isset($_GET['m']) )
        {
            $year = $_GET['y'];
            $month = $_GET['m'] + 1;
            $calendar = Calendar::model()->limitMonth($year,$month)->getClubCalendar($id);
            $events = $calendar?$calendar->events:array();
        }
        else
        {
            $events = Calendar::model()->getClubCalendar($id)->events;
        }
        foreach ( $events as $key => $event )
        {
            $this->_data['events'][$key]['id'] = $event->id;
            $this->_data['events'][$key]['start'] = $event->start;
            $this->_data['events'][$key]['name'] = $event->name;
            $this->_data['events'][$key]['end'] = $event->end;
            $this->_data['events'][$key]['invisible'] = $event->invisible;
        }
    }

    protected function loadPersonalCalendar()
    {
        $calendar = Calendar::model()->getPersonalCalendar();
        if ( ! $calendar  )
        {
            return Calendar::model()->createPersonalCalendar();
        }
        return $calendar;
    }
}