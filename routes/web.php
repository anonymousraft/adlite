<?php

use Inc\Routes\Router;

//Router::csrfVerifier(new \Inc\Middlewares\CsrfVerifier());

Router::setDefaultNamespace('\Inc\Controllers');

Router::group(['exceptionHandler' => \Inc\Handlers\CustomExceptionHandler::class], function () {

    Router::get('/','HomeController@index');
    /**
     * To migrate the Table for the first time;
     */
    Router::get('/migrate', [\Inc\Migration\DBSeed::class, 'migrate']);

     // login
    // Router::group(['prefix' => '/login', 'middleware' => \Inc\Middlewares\LoginVerfication::class], function () {

    //     /**
    //      * User login to create API key
    //      */
    //     Router::post('/', 'UserController@login');

    //     /**
    //      * Login Token
    //      */
    //     Router::get('/token', 'UserController@token');


    //     /** 
    //      * Register Token
    //      */
    //     Router::post('/register', 'UserController@register');
    // });
});
