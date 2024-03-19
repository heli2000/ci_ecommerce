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
                if ($user['isVerified'] == true) {
                    $this->session->set('user', $user);
                    return redirect()->to(base_url('/'));
                } else {
                    if (sendOtpAndEmail($user['id'], $user['email'], $this->otpModel, $this->emailController)) {
                        return view('Authentication\otpVerification.php', ['uid' => $user['id'], "validation" => $this->validation]);
                    } else {
                        $this->validation->setError('EmailFailed', 'Something went wrong. Email is not being sent please contact admin.');
                        return view('Authentication\register.php', ['validation' => $this->validation]);
                    }
                }
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

            $existingUser = $this->userModel->where('email', $data['email'])->first();

            if ($existingUser) {
                $this->validation->setError('UserExist', 'User already exist, please login');
                return view('Authentication\register.php', ['validation' => $this->validation]);
            } else {
                $data["password"] = base64_encode($this->encrypter->encrypt($data["password"]));
                $data['createdAt'] = time();
                $data['updatedAt'] = time();

                $this->userModel->insert($data);

                $insert_id = $this->userModel->insertID();

                if (sendOtpAndEmail($insert_id, $data['email'], $this->otpModel, $this->emailController)) {
                    return view('Authentication\otpVerification.php', ['uid' => $insert_id, "validation" => $this->validation]);
                } else {
                    $this->validation->setError('EmailFailed', 'Something went wrong. Email is not being sent please contact admin.');
                    return view('Authentication\register.php', ['validation' => $this->validation]);
                }
            }
        } else if ($this->request->is('get')) {
            return view('Authentication\register.php', ['validation' => $this->validation]);
        }
    }

    public function otpVerify()
    {
        if ($this->request->is('post')) {
            $otp =  $this->request->getPost('otp');
            $uid =  $this->request->getPost('uid');
            $isSetNewPass = $this->request->getPost('isSetNewPass');

            $validationRules = [
                'otp' => 'required',
            ];

            // Validate the data against the rules from UserModel
            if (!$this->validateData(['otp' => $otp], $validationRules)) {
                return view('Authentication\otpVerification.php', ['uid' => $uid, 'isSetNewPass' => $isSetNewPass, 'validation' => $this->validation]);
            }

            $user = $this->userModel->where('id', $uid)
                ->first();
            if (array_key_exists('resend', $this->request->getPost())) {
                if (!sendOtpAndEmail($uid, $user['email'], $this->otpModel, $this->emailController)) {
                    $this->validation->setError('EmailFailed', 'Something went wrong. Email is not being sent please contact admin.');
                }
                return view('Authentication\otpVerification.php', ['uid' => $uid, 'isSetNewPass' => $isSetNewPass, 'validation' => $this->validation]);
            } else if (array_key_exists('verify', $this->request->getPost())) {
                $data = $this->otpModel->where('userId', $uid)
                    ->first();

                if ($data && $data['otp'] == $otp) {
                    if ($data['expireTime'] > time()) {
                        if ($isSetNewPass) {
                            session()->setFlashdata('message', 'set new password');
                            return view('Authentication\setNewPassword.php', ['uid' => $uid, 'validation' => $this->validation]);
                        } else {
                            $this->userModel->set('isVerified', 1);
                            $this->userModel->set('updatedAt', time());
                            $this->userModel->where('id', $uid);
                            $this->userModel->update();

                            session()->setFlashdata('message', 'verification done successfully you can login now');
                            return redirect()->to(base_url('/login'));
                        }
                    } else {
                        $this->validation->setError('otp', 'Otp is expired');
                        return view('Authentication\otpVerification.php', ['uid' => $uid, 'isSetNewPass' => $isSetNewPass, 'validation' => $this->validation]);
                    }
                } else {
                    $this->validation->setError('otp', 'Invalid otp');
                    return view('Authentication\otpVerification.php', ['uid' => $uid, 'isSetNewPass' => $isSetNewPass, 'validation' => $this->validation]);
                }
            }
        }
    }

    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $email =  $this->request->getPost('email');
            $validationRules = [
                'email' => 'required',
            ];

            // Validate the data against the rules from UserModel
            if (!$this->validateData(['email' => $email], $validationRules)) {
                return view('Authentication\forget-password.php', ['validation' => $this->validation]);
            }
            $user = $this->userModel->where('email', $email)
                ->first();

            if ($user) {
                if (sendOtpAndEmail($user['id'], $user['email'], $this->otpModel, $this->emailController)) {
                    return view('Authentication\otpVerification.php', ['uid' => $user['id'], 'isSetNewPass' => true, 'validation' => $this->validation]);
                } else {
                    $this->validation->setError('EmailFailed', 'Something went wrong. Email is not being sent please contact admin.');
                    return view('Authentication\forgotPassword.php', ['validation' => $this->validation]);
                }
            } else {
                $this->validation->setError('UserExist', 'User is not exist, please register');
                return view('Authentication\forgotPassword.php', ['validation' => $this->validation]);
            }
        } else  if ($this->request->is('get')) {
            return view('Authentication\forgotPassword.php', ['validation' => $this->validation]);
        }
    }

    public function setNewPassword()
    {
        $password =  $this->request->getPost('password');
        $cpassword =  $this->request->getPost('cpassword');
        $uid =  $this->request->getPost('uid');

        $validationRules = [
            'password' => 'required|max_length[255]|min_length[8]',
            'cpassword' => 'required|max_length[255]|matches[password]',
        ];

        // Validate the data against the rules from UserModel
        if (!$this->validateData(['password' => $password, 'cpassword' => $cpassword], $validationRules)) {
            return view('Authentication\setNewPassword.php', ['uid' => $uid, 'validation' => $this->validation]);
        }

        $newPassword = base64_encode($this->encrypter->encrypt($password));

        $this->userModel->set('password', $newPassword);
        $this->userModel->set('updatedAt', time());
        $this->userModel->where('id', $uid);
        $this->userModel->update();

        session()->setFlashdata('message', 'Password has been updated successfully');
        return view('Authentication\login.php', ['validation' => $this->validation]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
