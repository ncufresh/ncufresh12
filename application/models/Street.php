<?php
class Street extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{building_info_content}}';
    }
    
    public function getBuildingInfo($id)
    {     
        $data = $this->findByPk($id);        
        return $data;        
    }
    
}

?>