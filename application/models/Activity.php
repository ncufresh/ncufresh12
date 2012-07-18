<?php

class Activity extends CActiveRecord
{
    const STATE_CLEAN_TIMEOUT = 3600;

    const STATE_UPDATE_TIMEOUT = 30;

    static private $_persister;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{activities}}';
    }

    public function behaviors()
    {
        return array(
            'Helper'
        );
    }

    public function getId()
    {
        return $this->user_id ?: 0;
    }

    public function setId($id)
    {
        $this->user_id = $id;
    }

    public static function updateActivityState()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'timestamp < :timestamp';
        $criteria->params = array(
            ':timestamp'  => TIMESTAMP - self::STATE_UPDATE_TIMEOUT - 5
        );

        $data = self::getPersister()->load() ?: array(
            'cleaned'   => 0,
            'counter'   => 0
        );

        if ( TIMESTAMP - $data['cleaned'] > self::STATE_CLEAN_TIMEOUT )
        {
            $table = self::model()->getTableSchema();
            $builder = self::model()->getCommandBuilder();
            $command = $builder->createSqlCommand(
                'ALTER TABLE ' . $table->rawName . ' ENGINE = MEMORY'
            );
            $command->execute();
            $data['cleaned'] = TIMESTAMP;
        }

        $data['counter'] = $data['counter'] + self::model()->count($criteria);
        self::getPersister()->save($data);

        return self::model()->deleteAll($criteria);
    }

    public static function getOnlineCount()
    {
        return self::model()->count();
    }

    public static function getTotalCount()
    {
        $data = self::getPersister()->load();
        return $data['counter'] + self::getOnlineCount();
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() ) $this->uuid = $this->uuid();
            $this->id = Yii::app()->user->getId() ?: 0;
            $this->ip = $this->ip2long($this->getClientIP());
            $this->timestamp = TIMESTAMP;
            return true;
        }
        return false;
    }

    private static function getPersister()
    {
        if ( self::$_persister === null )
        {
            self::$_persister = new CStatePersister();
            self::$_persister->stateFile = Yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'counter.bin';
        }
        return self::$_persister;
    }
}