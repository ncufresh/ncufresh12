<?php

class Pager extends CWidget
{
    public $classname = 'pager';

    public $parameter = 'page';

    public $pager;

    public $url;

    public function init()
    {
    }

    public function run()
    {
        $this->render('pager');
    }
}