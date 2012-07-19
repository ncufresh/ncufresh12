<?php

class Game extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{game_character}}';
    }

    public function relations()
    {
        return array(
            'hair'    => array(  // hair¬°Itemsªºhair_id row
                self::BELONGS_TO,
                'Items',
                'hair_id'
            ),
            'eyes'    => array(
                self::BELONGS_TO,
                'Items',
                'eyes_id'
            ),
            'cloths'    => array(
                self::BELONGS_TO,
                'Items',
                'cloths_id'
            ),
            'pants'    => array(
                self::BELONGS_TO,
                'Items',
                'pants_id'
            ),
            'hands'    => array(
                self::BELONGS_TO,
                'Items',
                'hands_id'
            ),
            'shoes'    => array(
                self::BELONGS_TO,
                'Items',
                'shoes_id'
            ),
            'others'    => array(
                self::BELONGS_TO,
                'Items',
                'others_id'
            )
         );
    }

    public function getId($row)
    {
        return $this->findByPk($row)->id;
    }

    public function getUserId($row)
    {
        return $this->findByPk($row)->user_id;
    }

    public function getHairName($row)
    {
        return $this->findByPk($row)->hair->name;
    }

    public function getEyesName($row)
    {
        return $this->findByPk($row)->eyes->name;
    }

    public function getClothsName($row)
    {
        return $this->findByPk($row)->cloths->name;
    }

    public function getPantsName($row)
    {
        return $this->findByPk($row)->pants->name;
    }

    public function getHandsName($row)
    {
        return $this->findByPk($row)->hands->name;
    }

    public function getShoesName($row)
    {
        return $this->findByPk($row)->shoes->name;
    }

    public function getOthersName($row)
    {
        return $this->findByPk($row)->others->name;
    }

    public function getExpValue($row)
    {
        return $this->findByPk($row)->exp;
    }

    public function getMoneyValue($row)
    {
        return $this->findByPk($row)->money;
    }
}