<?php
class Club extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{clubs}}';
    }

    public function relations()
    {
        return array(
            'manager'   => array(
                self::BELONGS_TO,
                'users',
                'username'
            )
        );
    }

    public function getClub($clubid)
    {
        return $this->findByPk($clubid);
    }
}