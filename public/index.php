<?php

/**
 * Composer Autolaod
 */

if (file_exists(dirname(dirname(__FILE__)) . '/vendor/autoload.php')) {
    require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
}

if (class_exists('Inc\\Init')) {
    Inc\Init::start();
}
