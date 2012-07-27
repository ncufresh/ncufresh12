<?php

class Pager extends CWidget
{
    public $classname = 'pager';

    public $parameter = 'page';

    public $parameters = array();

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