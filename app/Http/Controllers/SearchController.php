<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\User;

class SearchController extends Controller
{
    //

    public function search(Request $request){

        //dd($request->query->all());
        $companies = User::whereHas('categories',function($q) use ($request){
            $q->whereIn('categories.id',$request->input('category'));
        })->State($request->state)->paginate(15);
       return view('app_view.display_list2')->with(['companies'=>$companies,'request'=>$request]);
    }

    public function search_by_typing(Request $request){
        $name = $request->name;
        $companies = User::with('categories')->where('name','like',"%".$name."%")->paginate(10);
        return view('app_view.display_list2')->with(['companies'=>$companies,'request'=>$request]);
    }
}
