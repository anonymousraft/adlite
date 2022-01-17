<?php

namespace Inc\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

use Inc\Models\UserModel;

class LoginVerfication implements IMiddleware
{
    public function handle(Request $request): void
    {  
       
            $request->authenticated = true;
  
    }

    private function loginAuth(array $input)
    {
        $usermodel = new UserModel();
        $res = $usermodel->getUser($input['user']);
        return $res;
    }
}
