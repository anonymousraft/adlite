<?php

/**
 * @package Project
 */

namespace Inc;

use Inc\Routes\Router;

final class Init{
    
    public static $routes;
    public static $db = null;
    public static $base = null;

    public static function start(){

        self::errorShow();
        Router::begin();
    }

    public static function errorShow()
    {
        
        /**
         * Errors
         */
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}