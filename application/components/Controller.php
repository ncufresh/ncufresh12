<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page.
     */
    public $breadcrumbs = array();
}