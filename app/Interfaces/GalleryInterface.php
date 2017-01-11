<?php

    namespace App\Interfaces;

    Interface GalleryInterface{

        public function uploadPhotos(array $files,array $captions);
        public function deletePhotos(array $files);
    }

?>