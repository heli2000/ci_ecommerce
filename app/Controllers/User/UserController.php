<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function login(): string
    {
        return view('Authentication\login.php');
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getPost('name'),
                'phoneNumber' => (int) $this->request->getPost('phoneNo'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'cpassword' => $this->request->getPost('cpassword'),
            ];

            $validationRules = [
                'name' => 'required|max_length[200]',
                'phoneNo' => 'required|max_length[12]',
                'email' => 'required|max_length[30]',
                'password' => 'required|max_length[255]|min_length[8]',
                'cpassword' => 'required|max_length[255]|matches[password]',
            ];

            // Validate the data against the rules from UserModel
            if (!$this->validateData($data, $validationRules)) {
                return view('Authentication\register.php', ['validation' => $this->validation]);
            }

            $this->userModel->insert($data);
            return view('Authentication\login.php');
        } else if ($this->request->is('get')) {
            return view('Authentication\register.php', ['validation' => $this->validation]);
        }
    }

    public function forgotPassword(): string
    {
        return view('Authentication\forgotPassword.php');
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
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
