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
    
    public function getIsMaster($clubid)
    {
        if ( Yii::app()->user->getid() ) 
        {
            $isMaster = $this->count('id = ' . $clubid . ' AND master_id = ' . Yii::app()->user->getid()) > 0 ? true : false;
        }
        else
        {
           $isMaster=false;
        }
        return $isMaster;
        
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
        $this->leader = htmlspecialchars($this->leader);
        $this->leader_phone = htmlspecialchars($this->leader_phone);
        $this->leader_email = htmlspecialchars($this->leader_email);
        $this->leader_binary = htmlspecialchars($this->leader_binary);
        $this->leader_msn = htmlspecialchars($this->leader_msn);
        $this->viceleader = htmlspecialchars($this->viceleader);
        $this->viceleader_phone = htmlspecialchars($this->viceleader_phone);
        $this->viceleader_email = htmlspecialchars($this->viceleader_email);
        $this->viceleader_binary = htmlspecialchars($this->viceleader_binary);
        $this->viceleader_msn = htmlspecialchars($this->viceleader_msn);
        $this->website = htmlspecialchars($this->website);
    }
}