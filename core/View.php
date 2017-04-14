<?php

namespace Core;

abstract class View
{

    public $controller;
    public $model;

    public $tpl_path;

    protected $find = [];
    protected $replace = [];

    public function __construct()
    {
        $this->tpl_path = $this->set_tpl_path();
    }

    public function set_controller(&$controller)
    {
        $this->controller = $controller;
    }

    public function set_model(&$model)
    {
        $this->model = $model;
    }

    public final function assign($name, $value)
    {
        $this->find[] = $name;
        $this->replace[] = $value;
    }

    public function set_tpl_path()
    {

    }

}