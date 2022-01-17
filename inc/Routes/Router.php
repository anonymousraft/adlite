<?php

namespace Inc\Routes;

use Pecee\SimpleRouter\SimpleRouter;
use Inc\Controllers\BaseController;

class Router extends SimpleRouter
{
    /**
     * @throws \Exception
     * @throws \Pecee\Http\Middleware\Exceptions\TokenMismatchException
     * @throws \Pecee\SimpleRouter\Exceptions\HttpException
     * @throws \Pecee\SimpleRouter\Exceptions\NotFoundHttpException
     */
    public static function begin(): void
	{
		// Load our helpers
		$root = new BaseController();
        $root->helperFile();
        $root->routeFile();

		// Do initial stuff
		parent::start();
	}
}