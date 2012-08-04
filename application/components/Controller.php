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

    protected $_data = array();

    public function init()
    {
        parent::init();
        Activity::updateActivityState();
        $activity = Activity::model()->findByPk(Yii::app()->session['uuid']);
        if ( is_null($activity) ) $activity = new Activity();
        $activity->save();
        Yii::app()->session['uuid'] = $activity->uuid;
        Yii::app()->format->dateFormat = 'Y-m-d';
        Yii::app()->format->datetimeFormat = 'Y-m-d h:i:s A';

        mb_internal_encoding('UTF-8');
        return true;
    }

    protected function beforeAction($action)
    {
        if ( parent::beforeAction($action) )
        {
            if ( Yii::app()->request->getIsAjaxRequest() )
            {
                header('Content-Type: application/json; charset=utf-8');
            }
            return true;
        }
        return false;
    }

    protected function afterAction($action)
    {
        parent::afterAction($action);
        if ( Yii::app()->request->getIsAjaxRequest() && $this->_data !== false )
        {
            if ( Yii::app()->request->getIsPostRequest() )
            {
                $this->_data['token'] = Yii::app()->security->getToken();
            }
            echo json_encode($this->_data);
        }
    }
}