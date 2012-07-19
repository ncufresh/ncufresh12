// <?php
class Department extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{building_info_content}}';
    }

    public function rules()
    {
        return array(
            array('content, department_id', 'required'),
        );
    }

    public function getDepartment() // 取得系所
    {   
        
        return $this->findAll(array(  //相當於select
            'order'     => 'department_id ASC', //還有'limit'   'condition'(跟where一樣) 'order'(排序)
        ));
    }
    
}