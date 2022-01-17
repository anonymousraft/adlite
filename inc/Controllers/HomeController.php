<?php

/** 
 * @package Adlite
 */

namespace Inc\Controllers;

use Inc\View\HomeView;

class HomeController extends HomeView
{

    public function index()
    {
        $this->main();
    }

    
}
