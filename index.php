<?php

define ('ROOT_DIR', dirname(__FILE__));

function __autoload( $className )
{
  include_once $className . '.php';
}

Core\Core::execute();