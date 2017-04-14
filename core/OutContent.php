<?php

class OutContent
{

    public static function execute(&$content)
    {
        header('Content-type: text/html; charset=utf-8');
        echo $content;
    }

}