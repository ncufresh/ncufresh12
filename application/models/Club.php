<?php
class Club extends CActiveRecord
{
    private static $category_name = array(
        '',
        '社團',
        '系所',
        '學生組織'
    );


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
    
    public function rules()
    {   
        return array(
            array(
                'introduction, 
                leader, 
                leader_phone, 
                leader_email,
                leader_binary, 
                leader_msn, 
                viceleader,
                viceleader_phone, 
                viceleader_email, 
                viceleader_binary, 
                viceleader_msn, 
                website',
                'safe'
            ),
            array('introduction', 'length', 'max' => 500),
        );
    }   

    public function tableName()
    {
        return '{{clubs}}';
    }
    
    public function getClubByMasterId($master_id)
    {
        return $this->find(array(
            'condition' => 'master_id = :master_id',
            'params' => array(
                ':master_id' => $master_id
            )
        ));
    }
    
    public function getIsAdmin($clubid)
    {
        if ( Yii::app()->user->getid() ) 
        {
            $isAdmin = $this->count('id = ' . $clubid . ' AND master_id = ' . Yii::app()->user->getid()) > 0 ? true : false;
            $isAdmin = $isAdmin || Yii::app()->user->getIsAdmin();
        }
        else
        {
           $isAdmin=false;
        }
        return $isAdmin;
    }

    public static function getCategoryName( $category )
    {
        return Club::$category_name[$category];
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->introduction = nl2br(htmlspecialchars($this->introduction));
    }
}