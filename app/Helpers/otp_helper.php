<?php

if (!function_exists("generateOTP")) {
    function generateOTP($length = 6)
    {
        $characters = '0123456789';
        $otp = '';

        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }
}

if (!function_exists("sendOtpAndEmail")) {
    function sendOtpAndEmail($userId, $email, $otpModel, $emailController)
    {
        $otp = generateOTP();
        $expireTime = time() + 600;

        $existingUser = $otpModel->where('userId', $userId)->first();

        if ($existingUser) {
            $otpModel->set('otp', $otp);
            $otpModel->set('expireTime', $expireTime);
            $otpModel->where('userId', $userId);
            $otpModel->update();
        } else {
            $otpModel->insert([
                'userId' => $userId,
                'otp' => $otp,
                'expireTime' => $expireTime,
            ]);
        }

        $emailData = [
            'emailAddress' => $email,
            'subject' => 'Verification',
            'message' => '<p>Use <b>' . $otp . '</b> for verification of Email Address. Do not share with anyone.</p><p>
                                        <p>Regards,</p>
                                        <p>Hex Shopping</p></p>',
        ];

        if ($emailController->sendEmail($emailData)) {
            session()->setFlashdata('message', 'OTP has been sent to your email address');
            return true;
        } else {
            return false;
        }
    }
}
