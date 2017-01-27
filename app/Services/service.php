<?php
namespace App\Service;


use App\Category;
use App\User;
use App\Vicinity;
use App\Gallery;
 use App\Interfaces\RequestInterface;
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

    public static function getFiveCompanies(){
        return User::has('reviews')->take(5)->get();
    }

    public static function getStates(){

        /*$expiresAt = Carbon::now()->addMinutes(1);
        return $value = Cache::remember('states', $expiresAt,function (){
            return  DB::table('states')->select('state')->OrderBy('state')->get();
        });*/

         return  DB::table('states')->select('*')->OrderBy('state')->get();
    }

    public static function getImages($directory){
        $files = File::files($directory);
        return $files;
    }

    public static function getTop5Companies(){
        return User::with(['galleries','reviews'=>function($q){

            $q->select(DB::raw(`*,((select count("reviews_for") from reviews)/(select count(distinct reviews_for from reviews))
                as 'avg_num_votes'
                (select avg("ratings") from reviews) as 'avg_rating',count("reviews_for") as 'this_num_votes',
                avg("ratings") as 'this_num_ratings' from ratings groupby ratings,reviews_for
            `));
        }])->take(5)->get();    
    }

    public static function getEvents(){
        return DB::table('events')->select('name')->OrderBy('name')->get();
    }

    /*public static function createNewUser($data){

        $filtered =  array_except($data,['password_confirm','category','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        //$filtered['description'] = htmlentities($filtered['description']);
        $name_slug =  ['name_slug'=>str_slug($filtered['name'])];
        $filtered = array_merge($filtered,$name_slug);
        $user =  User::create($filtered);

        $user->categories()->attach($data['category']);
        return $user;
    }*/

    public static function createNewUser($data){
         $filtered =  array_except($data,['password_confirm','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $user =  User::create($filtered);

        return $user;
    }

    public static function deletePhotos(GalleryInterface $gallery,array $files){

        return $gallery->deletePhotos($files);
            
    }

    public static function uploadPhotos(GalleryInterface $gallery,array $files,array $captions,string $name_slug){

        return $gallery->uploadPhotos($files,$captions,$name_slug);
    }

    public static function formRules(RequestInterface $request){

        return $request->rules(); 
    }

    public static function getVicinities(){
        return Vicinity::OrderBy('name')->get();
    }

    public static function getCategoriesStatesVicinities(){

    }
   
}