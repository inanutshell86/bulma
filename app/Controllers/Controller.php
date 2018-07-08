<?php

namespace App\Controllers;

use App\Models\Roles;
use League\Plates\Engine;
use App\Models\Database;
use Delight\Auth\Auth;

class Controller
{
    protected $view;
    protected $db;
    protected $auth;

    public function __construct()
    {
        $this->view = components(Engine::class);
        $this->db = components(Database::class);
        $this->auth = components(Auth::class);
    }

    function checkForAccess()
    {
        if ($this->auth->hasRole(Roles::USER)) {
            return redirect('/');
        }
    }
}