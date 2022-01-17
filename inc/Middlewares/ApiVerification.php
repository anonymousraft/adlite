<?php

namespace Inc\Middlewares;

use Okta\JwtVerifier\JwtVerifierBuilder;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;


class ApiVerification implements IMiddleware
{

    public $headers;
    public $user_model;

    public function handle(Request $request): void
    {

        if ($this->authenticate()) {
            $request->authenticated = true;
        } else {
            response()->httpCode(403)->json(['error' => 'Unauthenticated']);
        }
    }

    public function authenticate()
    {
       return true;
    }
}
