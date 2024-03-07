<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function login(): string
    {
        return view('Authentication\login.php');
    }

    public function register(): string
    {
        return view('Authentication\register.php');
    }

    public function forgotPassword(): string
    {
        return view('Authentication\forgotPassword.php');
    }
}
