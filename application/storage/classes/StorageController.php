<?php

class StorageController extends Core\Controller
{

    /**
     * @var StorageModel
     */
    public $model;

    /**
     * @var StorageView
     */
    public $view;

    protected function set_helpers()
    {
        StorageCryptHelper::set_model_view($this->model, $this->view);
    }

    /**
     * Обработчик по умолчанию
     */
    protected function do_default()
    {
        $this->view->show_page();
    }

    /**
     * Обработчик формы
     */
    protected function act_form()
    {
        $this->view->after_send_form();
    }

}