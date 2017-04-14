<?php

class DB
{

    static $base;
    static $error = '';
    static $query_id = false;
    static $mysql_error = false;
    static $mysql_error_num;

    public static function connect($config)
    {
        self::$base = mysqli_connect($config['host'], $config['user'], $config['password'], $config['base'], $config['port']);
        define("COLLATE", $config['collate']);
        mysqli_query(self::$base, "SET NAMES '" . COLLATE . "'");
        return true;
    }

    public static function query($query)
    {
        if (!(self::$query_id = mysqli_query(self::$base, $query))) {
            self::$mysql_error = mysqli_error(self::$base);
            self::$mysql_error_num = mysqli_errno(self::$base);
        }
        return self::$query_id;
    }

    public static function get_row($query_id = '')
    {
        $query_id = self::get_query_id($query_id);
        return mysqli_fetch_assoc($query_id);
    }

    public static function get_array($query_id = '')
    {
        $query_id = self::get_query_id($query_id);
        return mysqli_fetch_array($query_id);
    }

    public static function get_query_id($query_id = '')
    {
        if (empty($query_id)) {
            $query_id = self::$query_id;
        }
        return $query_id;
    }

    public static function num_rows($query_id = '')
    {
        $query_id = self::get_query_id($query_id);
        return mysqli_num_rows($query_id);
    }

    public static function get_result_fields($query_id = '')
    {
        $query_id = self::get_query_id($query_id);
        $fields = [];
        while ($field = mysqli_fetch_field($query_id)) {
            $fields[] = $field;
        }
        return $fields;
    }

    public static function escape_string($source)
    {
        return mysqli_real_escape_string(self::$base, $source);
    }

    public static function free($query_id = '')
    {
        $query_id = self::get_query_id($query_id);
        mysqli_free_result($query_id);
    }

    public static function close()
    {
        mysqli_close(self::$base);
    }

}