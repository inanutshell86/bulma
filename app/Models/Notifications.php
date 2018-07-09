<?php

namespace App\Models;

class Notifications
{
    private $mailer;

    public function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    public function emailWasChanged($email, $selector, $token)
    {
        $msg = 'https://php02/verify_email?selector=' . \urlencode($selector) . '&token' . \urlencode($token);

        $this->mailer->send($email, $msg);
    }

}