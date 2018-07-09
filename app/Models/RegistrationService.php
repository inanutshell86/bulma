<?php

namespace App\Models;

use Delight\Auth\Auth;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class RegistrationService
{
    private $auth;
    private $db;
    private $notifications;

    public function __construct(Auth $auth, Database $db, Notifications $notifications)
    {
        $this->auth = $auth;
        $this->db = $db;
        $this->notifications = $notifications;
    }

    public function make($email, $password, $username)
    {
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) use ($email) {
            $this->notifications->emailWasChanged($email, $selector, $token);
        });
        $this->db->update('users', $userId, ['roles_mask' => Roles::USER]);

        return $userId;
    }

    public function verify($selector, $token)
    {
        return $this->auth->confirmEmail($selector, $token);
    }

}