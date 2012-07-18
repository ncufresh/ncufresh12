<?php

class RawDataBehavior extends CActiveRecordBehavior
{
    public $reloadAfterSave = true;

    private $_raws = array();

    public function isAnyChanged()
    {
        if ( empty($this->_raws) ) return false;

        $changed_attribute_counts = count(array_diff(
            $this->owner->attributes,
            $this->_raws
        ));
        return $changed_attribute_counts > 0;
    }

    public function isChanged($attribute)
    {
        if (
            array_key_exists($attribute, $this->_raws)
         && array_key_exists($attribute, $this->owner->attributes)
        )
        {
            return $this->_raws[$attribute] != $this->owner->$attribute;
        }
        return false;
    }

    public function getRawValue($attribute)
    {
        if ( array_key_exists($attribute, $this->_raws) )
        {
            return $this->_raws[$attribute];
        }
        return null;
    }

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

    protected function getAttributesFromOwner()
    {
        $this->_raws = array();
        foreach ( $this->owner->attributes as $name => $value )
        {
            $this->_raws[$name] = $value;
        }
    }
}