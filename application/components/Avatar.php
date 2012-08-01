<?php

class Avatar extends CWidget
{
    public $id;

    public $link = false;

    public function init()
    {
        Yii::import('application.models.Game.*');
    }

    public function run()
    {
        $this->render('avatar', array(
            'id'            => $this->id,
            'link'          => $this->link,
            'components'    => Character::getAvatar($this->id)
        ));
    }
}