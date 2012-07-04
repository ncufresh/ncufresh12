<?php

class RawDataBehavior extends CActiveRecordBehavior
{
    public $reloadAfterSave = true;

    private $_old_attributes = array();

    public function afterFind($event)
    {
        parent::afterFind($event);
        $this->getAttributesFromOwner();
    }

    public function afterSave($event)
    {
        parent::afterSave($event);
        if ( $this->reloadAfterSave ) $this->getAttributesFromOwner();
    }

    public function isAttributesChanged()
    {
        if ( empty($this->_old_attributes) ) return false;

        $number_of_changed_attributes = count(array_diff($this->owner->attributes, $this->_old_attributes));
        return $number_of_changed_attributes > 0;
    }

    public function isAttributeChanged($attribute) {
        if (
            array_key_exists($attribute, $this->_old_attributes)
         && array_key_exists($attribute, $this->owner->attributes)
        )
        {
            return $this->_old_attributes[$attribute] != $this->owner->$attribute;
        }
        return false;
    }

    public function getOldAttributeValue($attribute)
    {
        if ( array_key_exists($attribute, $this->_old_attributes) )
        {
            return $this->_old_attributes[$attribute];
        }
        return null;
    }

    protected function getAttributesFromOwner()
    {
        $this->_old_attributes = array();
        foreach ( $this->owner->attributes as $name => $value )
        {
            $this->_old_attributes[$name] = $value;
        }
    }
}

?>