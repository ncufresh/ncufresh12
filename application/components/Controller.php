<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view.
     */
    public $layout = '//layouts/main';

    public function init()
    {
        parent::init();
        Activity::updateActivityState();
        $activity = Activity::model()->findByPk(Yii::app()->session['uuid']);
        if ( is_null($activity) ) $activity = new Activity();
        $activity->save();
        Yii::app()->session['uuid'] = $activity->uuid;
        return true;
    }

    public function getOnlineCount()
    {
        return Activity::getOnlineCount();
    }

    public function getTotalCount()
    {
        return Activity::getTotalCount();
    }
}