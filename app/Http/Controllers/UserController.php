<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;

use GuzzleHttp\Client;

use App\User;
use App\Service\Service;
use App\Interfaces\GalleryInterface;
use App\Review;

class UserController extends Controller
{
    //

    

    private $gallery_implementation;

    public function __construct(GalleryInterface $gallery_implementation){

        $this->gallery_implementation = $gallery_implementation;
         $this->path = asset('storage/images/');
    }

    public function home(){
        
        $user =  User::with([
                 'galleries'=>function($q){
                     $q->where('user_id',Auth::id());
                 }
        ]) ->find(Auth::id());
        return view('app_view.home')->with(['user'=>$user,'path'=>$this->path]);
    }

    public function updateProfile(RegisterFormRequest $request){
        
       
        $filtered = $request->except(['password_confirm','category','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $name_slug =  ['name_slug'=>str_slug($filtered['name'])];
        $filtered['vicinity_id'] = (int)$request->vicinity_id !== 0 ? (int)$request->vicinity_id:0 ;
        $filtered = array_merge($filtered,$name_slug);

      try{

         
          $user = User::where('id',Auth::id())->first();
          $user->update($filtered);
          $user->categories()->sync($request->category);
          return redirect('home')->with('message','Profile Updated');
                
      } 

      catch(Exception $e){
          dd('Error Encountered');
      }
    }

    public function showProfileForm(Request $request){
        $user = User::with(
             [
                    'categories'=>function($query){
                    $query->where('company_id','=',Auth::id());
                },
                'vicinity'=>function($query){
                    $query->where('id',Auth::user()->vicinity_id);
                }
        
        ])->where(['name_slug'=>Auth::user()->name_slug,'id'=>Auth::id()])
            ->get()->first();

        return view('app_view.edit')
                ->with(['user'=>$user,'formInputs'=>User::getFormInputs(),
                        'states'=>Service::getStates(),
                        'categories'=>Service::getCategories()]);
    }

    public function showGallery(){
       $user =  User::find(Auth::id());

       $user = User::with(['galleries'=>function($q){
           $q->where('user_id','=',Auth::id())->orderBy('id','desc');
       }])->find(Auth::id());

         return view('app_view.user_gallery')->with(['user'=>$user,'path'=>$this->path]);
    }

    public function uploadPhotos(Request $request){
      
        $this->validate($request,[
            'photo.*'=>'mimes:jpeg,bmp,png,jfif,gif'
        ],['size'=>'size must be less than 5MB']);

        

        $names = Service::uploadPhotos($this->gallery_implementation,$request->photo,$request->caption,Auth::user()->name_slug);
        if($request->ajax()){

            if(is_array($names))
                return json_encode(array('status'=>'Success','paths'=>$names));
             else
                return json_encode(array('status'=>'Upload Failed','file'=>$names));

        }
        
        return back();
    }

    public function deletePhotos(Request $request){

        if(count($request->images))
            Service::deletePhotos($this->gallery_implementation,$request->images);
        
        return back();
    }

    public function getReviews(Request $request,$filter = null){

        $query = Review::where('review_for',Auth::id());
        $query1 = Review::where('review_for',Auth::id());
        $reviews = null;
        $pagination = 2;
        $total_avg = $query1->select(DB::raw('count(rating) as total,avg(rating) as av'))->get();

        if($filter){
            if($filter == 'gt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','>=',$total_avg[0]->av]
                ])->paginate(2);
            }
            elseif($filter == 'lt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','<',$total_avg[0]->av]
                ])->paginate(2);
            }
        }

        else{
            $reviews = $query->paginate(3);
        }

        return view('app_view.reviews')->with(
            [
                'reviews'=>$reviews,
                'pagination'=>$pagination,
                'page'=>$request->query('page'),
                'total'=>$total_avg[0]->total,
                'avg'=>$total_avg[0]->av
            ]);
    }
}
