<?php

return [
    'default_controller' => 'Storage',

    //'root_dir' => .
    'include_path' =>
        ROOT_DIR . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR .

        PATH_SEPARATOR . ROOT_DIR . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'storage' .
        DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .

        PATH_SEPARATOR . ROOT_DIR . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'storage' .
        DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR
    ,

    'db' => [
        'host' => 'localhost',
        'port' => 3306,
        'collate' => 'utf8',
        'user' => '',
        'password' => '',
        'base' => '',
    ],
];