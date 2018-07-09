<?php

namespace App\Controllers;

use App\Models\RegistrationService;
use Delight\Auth\Auth;

class VerificationController extends Controller
{
    public function showForm()
    {
        echo $this->view->render('auth/verification-form');
    }

    public function verify()
    {
        try {
            $this->auth->confirmEmail($_GET['selector'], $_GET['token']);

            flash()->success(['Ваш email подвержден!']);
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error(['Неверный токен']);
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error(['Токен просрочен']);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error(['Email уже существует']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Попробуйте позже']);
        }

        return redirect('/login');
    }
}