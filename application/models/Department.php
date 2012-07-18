// <?php
class Department extends CActiveRecord
{
	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
	
    public function tableName()
    {
        return 'building_info_content';
    }
    public function rules()
	{
		return array(
			array('building_info_content, department_id', 'required'),
		);
        
	}
    public function getdepartment() //取得系所
    {
        $department = Department::model()->findByPk($id);
    
    }
    

}


?>