<?php

namespace App\Models;

use Delight\Auth\Auth;

class Profile
{
    private $auth;
    private $db;
    private $imageManager;
    private $notifications;

    public function __construct(Auth $auth, Mail $mail, Database $db, ImageManager $imageManager, Notifications $notifications)
    {
        $this->auth = $auth;
        $this->db = $db;
        $this->imageManager = $imageManager;
        $this->notifications = $notifications;
    }

    public function changeInformation($newEmail, $newUsername = null, $newImage)
    {
        if($this->auth->getEmail() != $newEmail) {
            $this->auth->changeEmail($newEmail, function ($selector, $token) use ($newEmail) {
                $this->notifications->emailWasChanged($newEmail, $selector, $token);
                flash()->success(['На вашу почту ' . $newEmail . ' был отправлен код с подтверждением.']);
            });
        }

        $user = $this->db->find('users', $this->auth->getUserId());

        $image = $this->imageManager->uploadImage($newImage, $user['image']);

        $this->db->update('users', $this->auth->getUserId(), [
            'username' => isset($newUsername) ? $newUsername : $this->auth->getUsername(),
            "image" => $image,
        ]);
    }

}