<?php

namespace App\Controllers;

use App\Models\Mail;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $mailer;
    private $profile;

    public function __construct(Mail $mailer, Profile $profile)
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->profile = $profile;
    }

    public function showInfo()
    {
        $user = $this->db->find('users', $this->auth->getUserId());
        echo $this->view->render('profile/info', compact('user'));
    }

    public function showSecurity()
    {
        echo $this->view->render('profile/security');
    }

    public function postInfo()
    {
        try {
            $this->profile->changeInformation($_POST['email'], $_POST['username'],  $_FILES['image']);
            flash()->success(['Профиль обновлен']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error(['Invalid email address']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email address already exists']);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error(['Account not verified']);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error(['Not logged in']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Too many requests']);
        }

        return back();
    }

    public function postSecurity()
    {
        try {
            $this->auth->changePassword($_POST['password'], $_POST['new_password']);
            flash()->success(['Password has been changed']);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error(['Not logged in']);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error(['Invalid password']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Too many requests']);
        }

        return back();
    }

}