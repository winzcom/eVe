<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Service\Service;
use App\User;
use App\Review;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Service::getFiveCompanies();
        //$companies = Service::getTop5Companies();
        return view('welcome')->with('companies',$companies);
    }

    public function writeReview(Request $request){

        
        Review::create($request->all());
        return back()->with('search_url',$request->search_url);
    }

    public function quotesRequest(Request $request){

        $query = null;
        if($request->company_category[0] !== ""){
             $categories = explode(',',$request->company_category[0]);
             $query = User::whereHas('categories',function($q) use ($request,$categories){
                             $q->whereIn('categories.id',$categories);
                    })->StateVicinity($request->state,$request->vicinity)->where('name','!=','null');
             
        }

        elseif($request->name_search !== ''){
            $name_search = $request->name_search;
            $query = User::where('name','=',$name_search);
        }
           
        else{
            $name_slug = $request->company_name;
            $query = User::where('name','=',$name_slug);
        }

        $users = $query->get()->pluck('email')->all();

        //$quote = QuotationRequest::create($request->all());
    }
}
