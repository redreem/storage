<?php

class StorageCryptHelper
{

    /**
     * @var StorageModel
     */
    public static $model;

    /**
     * @var StorageView
     */
    public static $view;

    /**
     * метод шифрования
     */
    public static $crypt_method = 'blowfish';

    public static function set_model_view(&$model, &$view)
    {
        self::$model = $model;
        self::$view = $view;
    }

    /**
     * Шифрование данных с ключем
     *
     * @param string $data - данные
     * @param string $key - ключ
     * @return string - возвращает зашифрованные данные
     */
    public static function encrypt($data, $key)
    {
        $crypter = mcrypt_module_open(self::$crypt_method, '', 'ecb', '');

        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($crypter), MCRYPT_RAND);
        mcrypt_generic_init($crypter, $key, $iv);
        $encrypted_data = mcrypt_generic($crypter, $data);
        mcrypt_generic_deinit($crypter);

        mcrypt_module_close($crypter);

        return $encrypted_data;
    }

    /**
     * Расшифровка данных с ключем
     *
     * @param string $data - зашифрованные данные
     * @param string $key - ключ
     * @return string - возвращает расшифрованные данные
     */
    public static function decrypt($data, $key)
    {
        $crypter = mcrypt_module_open(self::$crypt_method, '', 'ecb', '');

        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($crypter), MCRYPT_RAND);
        mcrypt_generic_init($crypter, $key, $iv);
        $decrypted_data = mdecrypt_generic($crypter, $data);
        mcrypt_generic_deinit($crypter);

        mcrypt_module_close($crypter);

        return $decrypted_data;
    }

}