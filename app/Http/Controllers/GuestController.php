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
}
