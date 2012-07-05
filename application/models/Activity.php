<?php

class Activity extends CActiveRecord
{
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
        $table = self::model()->getTableSchema();
        $builder = self::model()->getCommandBuilder();
        $command = $builder->createSqlCommand(
            'ALTER TABLE ' . $table->rawName . ' ENGINE = MEMORY'
        );
        $command->execute();

        $criteria = new CDbCriteria();
        $criteria->condition = 'updated < :updated';
        $criteria->params = array(':updated' => TIMESTAMP - self::STATE_UPDATE_TIMEOUT - 5);

        $counter = (self::getPersister()->load() ?: 0);
        $counter = $counter + self::model()->count($criteria);
        self::getPersister()->save($counter);

        return self::model()->deleteAll($criteria);
    }

    public static function getOnlineCount()
    {
        return self::model()->count();
    }

    public static function getTotalCount()
    {
        return self::getPersister()->load() + self::getOnlineCount();
    }

    protected function beforeSave()
    {
        if ( parent::beforeSave() )
        {
            if ( $this->getIsNewRecord() )
            {
                $this->uuid = md5(uniqid(mt_rand() . TIMESTAMP . rand(), true));
            }
            $this->id = Yii::app()->user->id ?: 0;
            $this->updated = TIMESTAMP;
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