<?php

/** 
 * @package Adlite
 */

namespace Inc\Controllers;

use Dotenv\Dotenv;
use Inc\Migration\DBConnector;

class BaseController
{

    public $app_name;
    public $app_url;
    public $app_root;
    public $resources;
    public $db_conn = null;
    public $db_query = null;
    public $db_exec = null;


    public function __construct()
    {
        $this->app_name = "Sitemap Status";
        $this->app_root = dirname(dirname(dirname(__FILE__)));
        $this->app_url = $this->appURL();
        $this->loadENV();
        $this->db_conn = new DBConnector();
        $this->resources = $this->assets();
    }

    private function appURL()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

        return $link;
    }

    public function routeFile()
    {
        require_once "$this->app_root/routes/web.php";
    }

    public function helperFile()
    {
        require_once "$this->app_root/inc/Routes/Helpers.php";
    }

    public function loadENV()
    {
        $dotenv = Dotenv::createImmutable($this->app_root);
        $dotenv->load();
    }

    public function debug($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        exit;
    }

    public function pageTitles()
    {
        $this->page_titles = [
            /**
         * page_name = 'page_title'
         */
        ];
    }

    public function view(String $page)
    {
        $this->headerHTML();
        $this->registerCSS();
        $this->bodyHTML();
        $this->page($page);
        $this->footerHTML();
        $this->registerJS();
        $this->bodyEnd();
    }

    private function page(String $page)
    {
        require_once "$this->app_root/inc/Page/$page.php";
    }

    private function registerCSS()
    {
        $css = $this->resources['css'];
        $css_html = "<link rel='stylesheet' href='$this->app_url/$css'>";
        printf("\n%s\n", $css_html);
    }

    private function registerJS()
    {
        $js = $this->resources['js'];
        $js_html = "<script src='$this->app_url/$js'></script>";
        printf("\n%s\n", $js_html);
    }

    private function headerHTML()
    {
        require_once "$this->app_root/inc/Layout/header.php";
    }

    private function bodyHTML()
    {
        require_once "$this->app_root/inc/Layout/body.php";
    }

    private function  footerHTML()
    {
        require_once "$this->app_root/inc/Layout/footer.php";
    }

    private function  bodyEnd()
    {
        require_once "$this->app_root/inc/Layout/bodyend.php";
    }

    private function assets()
    {
        $resources = [
            'css' => 'assets/css/bundle.css',
            'js' => 'assets/js/bundle.js'
        ];

        return $resources;
    }
}
