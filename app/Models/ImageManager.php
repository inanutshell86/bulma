<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as Image;

class ImageManager
{
    private $folder;

    public function __construct()
    {
        $this->folder = config('uploadsFolder');
    }

    public function checkImageExist($path)
    {
        if ($path != null && is_file($this->folder . $path) && file_exists($this->folder . $path)) {
            return true;
        }
    }

    public function uploadImage($img, $currImg = null)
    {
        if (!is_file($img['tmp_name']) && !is_uploaded_file($img['tmp_name'])) {
            return $currImg;
        }

        $this->deleteImg($currImg);
        $filename = strtolower(uniqid('', true) . '.' . pathinfo($img['name'], PATHINFO_EXTENSION));
        $img = Image::make($img['tmp_name']);
        $img->save($this->folder . $filename);

        return $filename;
    }

    public function deleteImg($img)
    {
        if ($this->checkImageExist($img)) {
            unlink($this->folder . $img);
        }
    }

    public function getImg($img)
    {
        if ($this->checkImageExist($img)) {
            return '/' . $this->folder . $img;
        }

        return '/img/no-user.png';
    }

    public function getDimensions($file)
    {
        if($this->checkImageExist($file)) {
            list($width, $height) = getimagesize($this->folder . $file);
            return $width . "x" . $height;
        }
    }

}