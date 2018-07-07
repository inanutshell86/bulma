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

    public function category($id)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 8;
        $photos = $this->db->getPaginatedFrom('photos', 'category_id', $id, $page, $perPage);
        $paginator = paginate(
            $this->db->getCount('photos', 'category_id', $id),
            $page,
            $perPage,
            "/category/$id?page=(:num)"
        );
        $category = $this->db->find('categories', $id);

        echo $this->view->render('category', [
            'photos' => $photos,
            'paginator' => $paginator,
            'category' => $category
        ]);
    }
}