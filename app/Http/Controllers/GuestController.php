<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
        $category = Category::all();
        return view('welcome')->with('category',$category);
    }
}
