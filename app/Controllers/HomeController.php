<?php

namespace App\Controllers;

use App\Models\ImageManager;

class HomeController extends Controller
{
    public function index()
    {
        $photos = $this->db->getAll("photos", 8);
        echo $this->view->render("home", ["photos" => $photos]);
    }
}