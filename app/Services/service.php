<?php
namespace App\Service;


use App\Category;

class Service{

    public static function getCategories(){
        return  Category::all();
    }
   
}