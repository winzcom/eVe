<?php

    namespace App\Interfaces;

    Interface GalleryInterface{

        public function uploadPhotos(array $files,array $captions,string $name_slug);
        public function deletePhotos(array $files);
    }

?>