<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(): string
    {
        return view('Layouts/login_layout');
    }
}
