<?php

namespace Core;

abstract class Controller
{

    public $model;
    public $view;
    public $action;

    public function __construct(&$model, &$view)
    {
        $this->model = $model;
        $this->model->set_controller($this);

        $this->view = $view;
        $this->view->set_controller($this);
        $this->view->set_model($this->model);

        $this->set_action();

        $this->set_helpers();

        if ($this->action != '') {
            $this->exec_action();
        } else {
            $this->do_default();
        }
    }

    private function set_action()
    {
        $this->action = Core::$action;
    }

    protected function exec_action()
    {
        $method_name = "act_" . $this->action;

        if (method_exists($this, $method_name)) {
            $this->$method_name();
        }
    }

    protected function set_helpers()
    {

    }

    protected function do_default()
    {

    }

}