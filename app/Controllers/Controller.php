<?php
namespace App\controllers;

use Simple\Routing\BaseController;
use App\Helper\Auth\AuthHelper as auth;
use Simple\Request;

class Controller extends BaseController 
{
    public function before()
    {
        if(!auth::user()) {
           Request::redirect('/auth/index');
        }
    }
    
}
