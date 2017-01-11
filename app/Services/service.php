<?php
namespace App\Service;


use App\Category;
use App\User;
use App\Gallery;
use App\Interfaces\GalleryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage; 


class Service{


    protected $files;
    public function __construct(){
        
    }

    public static function getCategories(){

        /*$expiresAt = Carbon::now()->addMinutes(10);

         return  $value = Cache::remember('categories',$expiresAt, function () {
                    return Category::OrderBy('name')->get();
          });*/

           return  Category::OrderBy('name')->get();

    }

    public static function getStates(){

        /*$expiresAt = Carbon::now()->addMinutes(1);
        return $value = Cache::remember('states', $expiresAt,function (){
            return  DB::table('states')->select('state')->OrderBy('state')->get();
        });*/

         return  DB::table('states')->select('state')->OrderBy('state')->get();
    }

    public static function getImages($directory){
        $files = File::files($directory);
        return $files;
    }

    public static function getEvents(){
        return DB::table('events')->select('name')->OrderBy('name')->get();
    }

    public static function createNewUser($data){

        $filtered =  array_except($data,['password_confirm','category','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $name_slug =  ['name_slug'=>str_slug($filtered['name'])];
        $filtered = array_merge($filtered,$name_slug);
        $user =  User::create($filtered);

        $user->categories()->attach($data['category']);
        return $user;
    }

    public static function deletePhotos(GalleryInterface $gallery,array $files){

        return $gallery->deletePhotos($files);
            
    }

    public static function uploadPhotos(GalleryInterface $gallery,array $files,array $captions){

        return $gallery->uploadPhotos($files,$captions);
    }

    public static function formRules(RegisterFormRequest $request){

        return $request->rules(); 
    }
   
}