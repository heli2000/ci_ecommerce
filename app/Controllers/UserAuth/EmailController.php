<?php

namespace App\Controllers\UserAuth;

use App\Controllers\BaseController;

class EmailController extends BaseController
{

    protected $emailLib;

    public function __construct()
    {
        $this->emailLib = \Config\Services::email();
    }

    public function sendEmail($emailData)
    {
        $this->emailLib->setFrom($this->emailLib->fromEmail);
        $this->emailLib->setTo($emailData['emailAddress']);
        $this->emailLib->setSubject($emailData['subject']);
        $this->emailLib->setMessage($emailData['message']);

        // Send the email
        if ($this->emailLib->send()) {
            return true;
        } else {
            print_r($this->emailLib->printDebugger(['headers']));
            exit;
            return $this->emailLib->printDebugger(['headers']);
        }
    }
}
