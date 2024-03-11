<?php

namespace App\Controllers\UserAuth;

use App\Controllers\BaseController;


class UserController extends BaseController
{
    public function login()
    {
        if ($this->request->is('post')) {
            $username = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validationRules = [
                'email' => 'required',
                'password' => 'required',
            ];

            // Validate the data against the rules from UserModel
            if (!$this->validateData(['email' => $username, 'password' => $password], $validationRules)) {
                return view('Authentication\login.php', ['validation' => $this->validation]);
            }

            $user = $this->userModel->where('email', $username)
                ->first();

            if ($user && $this->encrypter->decrypt(base64_decode($user['password'])) == $password) {
                $this->session->set('user', $user);
                return redirect()->to(base_url('/'));
            } else {
                $this->validation->setError('login', 'Invalid username or password');
                return view('Authentication\login.php', ['validation' => $this->validation]);
            }
        } else if ($this->request->is('get')) {
            return view('Authentication\login.php', ['validation' => $this->validation]);
        }
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getPost('name'),
                'phoneNumber' => $this->request->getPost('phoneNumber'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'cpassword' => $this->request->getPost('cpassword'),
            ];

            $validationRules = [
                'name' => 'required|max_length[200]',
                'phoneNumber' => 'required|numeric|max_length[12]',
                'email' => 'required|max_length[30]',
                'password' => 'required|max_length[255]|min_length[8]',
                'cpassword' => 'required|max_length[255]|matches[password]',
            ];

            // Validate the data against the rules from UserModel
            if (!$this->validateData($data, $validationRules)) {
                return view('Authentication\register.php', ['validation' => $this->validation]);
            }

            $data["password"] = base64_encode($this->encrypter->encrypt($data["password"]));

            $this->userModel->insert($data);
            // session()->setFlashdata('message', 'User Register successfully you can login now!!');
            $otp = generateOTP();
            $emailData = [
                'emailAddress' => $data['email'],
                'subject' => 'Verification',
                'message' => '<p>Use <b>' . $otp . '</b> for verification of Email Address. Do not share with anyone.</p><p>
                <p>Regards,</p>
                <p>Hex Shopping</p></p>',
            ];

            if ($this->emailController->sendEmail($emailData)) {
                session()->setFlashdata('message', 'OTP has been sent to your email address');
                return view('Authentication\otpVerification.php', ['email' => $data['email']]);
            } else {
                $this->validation->setError('EmailFailed', 'Something went wrong. Email is not being sent please contact admin.');
                return view('Authentication\register.php', ['validation' => $this->validation]);
            }
        } else if ($this->request->is('get')) {
            return view('Authentication\register.php', ['validation' => $this->validation]);
        }
    }

    public function forgotPassword(): string
    {
        return view('Authentication\forgotPassword.php');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
