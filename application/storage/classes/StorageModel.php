<?php

class StorageModel extends Core\Model
{

    public $sendFormSuccess;
    public $sendFormErrorDescription = '';
    public $phoneNumber;
    public $form_id;

    /**
     * Роутер поступивших данных
     */
    protected function data_process()
    {
        if (!empty($_REQUEST['form'])) {
            switch ($_REQUEST['form']) {
                case 1:
                    $this->form_1_process();
                    break;
                case 2:
                    $this->form_2_process();
                    break;
                default:
                    $this->sendFormSuccess = false;
                    break;
            }
        }
    }

    /**
     * Обработка данных с формы №1
     * Внесение нового номера в базу
     */
    protected function form_1_process()
    {
        $this->form_id = 1;
        $phone = !empty($_REQUEST['phone']) ? $this->filter_phone($_REQUEST['phone']) : '';
        $email = !empty($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) : '';

        if (empty($phone)) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Incorrect phone number';
            return;
        }

        if (empty($email)) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Incorrect e-mail';
            return;
        }

        $data = base64_encode(StorageCryptHelper::encrypt($phone, $email));
        $email_hash = base64_encode(sha1($email, true));

        $sql = "
            select
                p.phone_encrypted
            from phone p
            where
                p.email_hash = '" . $email_hash . "'
        ";

        DB::query($sql);

        if (DB::$mysql_error) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Data base error';
            return;
        }

        if (DB::num_rows() != 0) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Phone number already exists';
            return;
        }
        $sql = "
            insert into phone(phone_encrypted, email_hash)
            values(
                '" . $data . "',
                '" . $email_hash . "'
            )
        ";

        DB::query($sql);

        if (DB::$mysql_error) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Data base error';
            return;
        }

        $this->sendFormSuccess = true;
    }

    /**
     * Обработка данных с формы №2
     * Чтение номера из базы
     */
    protected function form_2_process()
    {
        $this->form_id = 2;

        $email = !empty($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) : '';

        if (empty($email)) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Incorrect e-mail';
            return;
        }

        $email_hash = base64_encode(sha1($email, true));

        $sql = "
            select
                p.phone_encrypted
            from phone p
            where
                p.email_hash = '" . $email_hash . "'
        ";

        DB::query($sql);

        if (DB::$mysql_error) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Data base error';
            return;
        }

        if (DB::num_rows() == 0) {
            $this->sendFormSuccess = false;
            $this->sendFormErrorDescription = 'Phone number not found';
            return;
        }

        $row = DB::get_row();

        $this->phoneNumber = StorageCryptHelper::decrypt(base64_decode($row['phone_encrypted']), $email);
        $this->sendFormSuccess = true;
    }

    /**
     * Валидатор номера телефона
     * @todo заглушка, надо реализовать
     */
    protected function filter_phone($phone_str)
    {
        return $phone_str;
    }

}