<?php

namespace Core;

abstract class Model
{

    /**
     * @var Controller
     */
    public $controller;

    public function __construct()
    {
        $this->data_process();
    }

    public function set_controller(&$controller)
    {
        $this->controller = $controller;
    }

    protected function data_process()
    {

    }

}