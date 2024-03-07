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

    public function createUser()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'phoneNumber' => (int) $this->request->getPost('phoneNo'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $this->userModel->insert($data);
        return view('Authentication\login.php');
    }

    public function loginUser()
    {

        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $username)
            ->where('password', $password)
            ->first();

        if ($user) {
            $this->session->set('user', $user);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }
}
