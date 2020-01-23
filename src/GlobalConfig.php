<?php

namespace SiteParser;


class GlobalConfig
{
    private static $instance = null;
    private static $config = null;

    private function __construct()
    {
        $config = file_get_contents('config.json');
        echo $config;
        print_r(json_decode($config));
        self::$config = json_decode($config);
    }

    public static function get($paramName)
    {
        self::getInstance();
        return self::$config->$paramName;
    }

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}