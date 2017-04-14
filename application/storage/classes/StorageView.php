<?php

class StorageView extends Core\View
{

    public function set_tpl_path()
    {
        return Core\Core::$application_root . 'storage' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    }

    /**
     * Ñòğàíèöà ñ ôîğìàìè
     */
    public function show_page()
    {
        $f1 = new Core\Template($this->tpl_path . 'form_option_1.php');
        $f2 = new Core\Template($this->tpl_path . 'form_option_2.php');

        $t = new StorageTemplate($this->tpl_path . 'layout.php');
        $t->assign('content', $f1->render() . $f2->render());

        OutContent::execute($t->render());
    }

    /**
     * Ğåçóëüòàòû îòïğàâêè ôîğì
     */
    public function after_send_form()
    {
        if ($this->model->sendFormSuccess) {

            $res = new Core\Template($this->tpl_path . 'form_success.php');

            switch ($this->model->form_id) {
                case 1:
                    $res->assign('result', '');
                    break;
                case 2:
                    $res->assign('result', ': your phone number is ' . $this->model->phoneNumber);
                    break;
                default:
                    $res->assign('result', '');
                    break;
            }

        } else {

            $res = new Core\Template($this->tpl_path . 'form_error.php');
            $res->assign('error', $this->model->sendFormErrorDescription);

        }

        $t = new StorageTemplate($this->tpl_path . 'layout.php');
        $t->assign('content', $res->render());
        OutContent::execute($t->render());
    }
}