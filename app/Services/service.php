<?php
namespace App\Service;


use App\Category;
use App\User;

class Service{

    public static function getCategories(){
        return  Category::all();
    }

    public static function createNewUser($data){

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name_slug'=>str_slug($data['name']),
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'description'=>$data['description']
        ]);

        $user->categories()->attach($data['category']);
        return $user;
    }
   
}