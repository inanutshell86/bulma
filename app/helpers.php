<?php

use App\Models\Database;
use App\Models\ImageManager as Image;
use League\Plates\Engine;

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