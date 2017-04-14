<?php

namespace Core;

class Core
{

    static $controller;
    static $action;
    static $config;
    static $application_root;

    public static final function execute()
    {
        self::$config = include ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';

        ini_set('include_path', self::$config['include_path']);

        $request_uri = trim($_SERVER['REQUEST_URI'], '/');

        $uri_params_index = strpos($request_uri, '?');
        if ($uri_params_index) {
            $route = substr($request_uri, 0, $uri_params_index);
        }
        $route = explode('/', (!isset($route) ? $request_uri : $route));

        if (!empty($route[0])) {
            self::$controller = $route[0];
        } else {
            self::$controller = self::$config['default_controller'];
        }

        if (!empty($route[1])) {
            self::$action = $route[1];
        }

        \DB::connect(self::$config['db']);
        self::$application_root = ROOT_DIR . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR;
        include self::$application_root . self::$controller . DIRECTORY_SEPARATOR . 'index.php';
    }

}