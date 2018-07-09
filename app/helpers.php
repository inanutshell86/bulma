<?php

use App\Models\Database;
use App\Models\ImageManager as Image;
use League\Plates\Engine;
use JasonGrimes\Paginator;
use Delight\Auth\Auth;
use App\Models\Roles;

function config($field)
{
    $config = require '../app/config.php';

    return array_get($config, $field);
}

function components($name) {
    global $container;

    return $container->get($name);
}

function getCategory($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $db = new Database($pdo, $queryFactory);

    return $db->find('categories', $id);
}

function getAllCategories()
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $db = new Database($pdo, $queryFactory);

    return $db->getAll('categories');
}

function uploadedDate($timestamp)
{
    return date("d.m.Y", $timestamp);
}

function abort($type)
{
    switch ($type) {
        case 404:
            $view = components(Engine::class);
            echo $view->render('errors/404');
            break;
    }
}

function getImg($img)
{
    $pic = new Image();

    return $pic->getImg($img);
}

function paginate($count, $page, $perPage, $url)
{
    $totalItems = $count;
    $itemsPerPage = $perPage;
    $currPage = $page;
    $urlPattern = $url;

    $paginator = new Paginator($totalItems, $itemsPerPage, $currPage, $urlPattern);

    return $paginator;
}

function paginator($paginator)
{
    include(dirname(__FILE__) . "/Views/partials/pagination.php");
}

function auth()
{
    global $container;

    return $container->get(Auth::class);
}

function redirect($path) {
    header("Location: $path");exit;
}

function back() {
    header("Location: " . $_SERVER['HTTP_REFERER']);exit;
}

function getRole($key)
{
    return Roles::getRole($key);
}
