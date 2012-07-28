<?php

class Avatar extends CWidget
{
    public $id;

    public function init()
    {
        Yii::import('application.models.Game.*');
    }

    public function run()
    {
        $this->render('avatar', array(
            'components'    => Character::getAvatar($this->id)
        ));
    }
}