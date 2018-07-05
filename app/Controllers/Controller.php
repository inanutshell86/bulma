<?php

namespace App\Controllers;

use League\Plates\Engine;
use App\Models\Database;
use App\Models\ImageManager;

class Controller
{
    protected $view;
    protected $db;

    public function __construct()
    {
        $this->view = components(Engine::class);
        $this->db = components(Database::class);
    }
}