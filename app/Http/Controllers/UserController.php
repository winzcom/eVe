<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterFormRequest;

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
        
        $user =  User::find(Auth::user()->id);
        return view('app_view.home')->with(['user'=>$user,'path'=>$this->path]);
    }

    public function updateProfile(RegisterFormRequest $request){

        $filtered = $request->except(['password_confirm','category','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $name_slug =  ['name_slug'=>str_slug($filtered['name'])];
        $filtered = array_merge($filtered,$name_slug);

      try{

          $id = Auth::user()->id;
          $user = User::where('id',$id)->get()->first();
          User::where('id',$id)->update($filtered);
          $user->categories()->sync($request->category);
          return redirect('home')->with('message','Profile Updated');
                
      } 

      catch(Exception $e){
          dd('Error Encountered');
      }
    }

    public function showProfileForm(Request $request){
        $user = User::where(['name_slug'=>Auth::user()->name_slug,'id'=>Auth::user()->id])->get()->first();
        return view('app_view.edit')
                ->with(['user'=>$user,'formInputs'=>User::getFormInputs(),
                        'states'=>Service::getStates(),
                        'categories'=>Service::getCategories()]);
    }

    public function showGallery(){
       $user =  User::find(Auth::user()->id);

       $user = User::with(['galleries'=>function($q){
           $q->orderBy('id','desc');
       }])->find(Auth::user()->id);
         return view('app_view.user_gallery')->with(['user'=>$user,'path'=>$this->path]);
    }

    public function uploadPhotos(Request $request){
      
        $this->validate($request,[
            'photo.*'=>'mimes:jpeg,bmp,png,jfif,gif'
        ],['size'=>'size must be less than 5MB']);

        

        $names = Service::uploadPhotos($this->gallery_implementation,$request->photo,$request->caption);
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

    public function getReviews(){
        $reviews = Review::where('review_for',Auth::id())->get();
        $positives = $reviews->filter(function($review){
            return $review->rating >=3; 
        });

        $negatives = $reviews->filter(function($review){
            return $review->rating<3;
        });
        return view('app_view.reviews')->with(['reviews'=>$reviews,
                        
                            'positives'=>$positives,
                            'negatives'=>$negatives,
                            'average'=>$reviews->avg()
            ]);
    }
}
