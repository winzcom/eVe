<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;

use GuzzleHttp\Client;
use Carbon\Carbon;
use App\User;
use App\Service\Service;
use App\Interfaces\GalleryInterface;
use App\Gallery;
use App\Review;
use App\OffDays;

class UserController extends Controller
{
    //

    

    private $gallery_implementation;
    private $period;

    public function __construct(GalleryInterface $gallery_implementation){

        $this->gallery_implementation = $gallery_implementation;
         $this->path = asset('storage/images/');
        // $this->period = $this->computeDays();

    }

    public function home(){
        
        $user =  User::with([
                 'galleries',
                 'reviews'=>function($q){
                     $q->orderBy('id','desc');
                 },
                 'offdays'
        ]) ->find(Auth::id());
        return view('app_view.home')->with(['user'=>$user,'path'=>$this->path]);
    }

    private function computeDays(){
                $begin = new Carbon(); 
                $begin->addDays(1);
                $end = $begin->copy()->addMonths(3);
                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);
            
                return $period;
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
    
        $galleries = Gallery::where('user_id',Auth::id())->orderBy('id','desc')->get();
         return view('app_view.user_gallery')->with(['galleries'=>$galleries,'path'=>$this->path]);
    }

    public function publish(Request $request){

        $query = Gallery::where('id',$request->image_id);
        if($request->published == "true")
            $query->update(['publish'=>1]);
        else 
            $query->update(['publish'=>0]);
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
        $pagination = 3;
        $total_avg = $query1->select(DB::raw('count(rating) as total,avg(rating) as av'))->get();

        if($filter){
            if($filter == 'gt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','>=',$total_avg[0]->av]
                ])->paginate($pagination);
            }
            elseif($filter == 'lt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','<',$total_avg[0]->av]
                ])->paginate($pagination);
            }
        }

        else{
            $reviews = $query->paginate($pagination);
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

    public function addOffDays(Request $request){
        $from_date = date("Y-m-d",strtotime($request->from_date));

        if($request->to_date == null || $request->to_date == '' || empty($request->to_date)){
            $to_date = $from_date;
        }
        else 
            $to_date = date("Y-m-d",strtotime($request->to_date));
        
        if($request->ajax()){
           $offdays =  OffDays::create(['from_date'=>$from_date,
                            'to_date'=>$to_date,
                            'user_id'=>Auth::id()
                        ]);
                return json_encode(array('from_date'=>$offdays->from_date->format('l jS \\of F Y'),
                                         'to_date'=>$offdays->to_date->format('l jS \\of F Y'),
                                         'date_id'=>$offdays->id
                ));
        }
    }//end of addOffDays

    public function removeOffDays(Request $request){

        if($request->ajax()){
             OffDays::where(['id'=>$request->date_id,
                        'user_id'=>Auth::id()
            ])->delete();
            return json_encode(array('status'=>'Date Deleted'));
        }
       
    }
}
