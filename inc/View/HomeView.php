<?php

namespace Inc\View;

use Inc\Controllers\BaseController;

class HomeView extends BaseController
{

    public function main()
    {
        $this->view('Home');
    }
}
