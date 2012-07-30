<?php
class Club extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function behaviors()
    {
        return array(
            'RawDataBehavior'
        );
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
    
    public function getRawClub($clubid)
    {
        $club = $this->findByPk($clubid);
        $club->introduction = $club->getRawValue('introduction');
        return $club;
    }

    public function getClub($clubid)
    {
        return $this->findByPk($clubid);
    }

    public function getClubByManagerrId($manager_id)
    {
        return $this->find(array(
            'condition' => 'master_id = :master_id',
            'params' => array(
                ':master_id' => $manager_id
            )
        ));
    }
    
    public function getIsAdmin($clubid)
    {
        if ( Yii::app()->user->getid() ) 
        {
            $isAdmin = $this->count('id = ' . $clubid . ' AND manager_id = ' . Yii::app()->user->getid()) > 0 ? true : false;
            $isAdmin = $isAdmin || Yii::app()->user->getIsAdmin();
        }
        else
        {
           $isAdmin=false;
        }
        return $isAdmin;
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->introduction = nl2br(htmlspecialchars($this->introduction));
    }
}