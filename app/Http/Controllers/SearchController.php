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

       
        /*$companies = DB::table('companies')
                        ->join('company_category','companies.id','=','company_category.company_id')
                        ->join('categories','categories.id','=','company_category.category_id')
                        ->select(DB::raw('distinct(companies.name) as CN,companies.email as CE,companies.web_page as CW,
                            companies.description as DE,companies.name_slug as NS
                        '))
                        ->whereIn('categories.id',$request->input('category'))
                        ->get();*/

      //dd($companies);

      /*$companies = User::select(DB::raw('distinct(companies.name) as CN,companies.email as CE,companies.web_page as CW,
                            companies.description as DE,companies.name_slug as NS
                        '))->join('company_category','companies.id','=','company_category.company_id')
                        ->join('categories','categories.id','=','company_category.category_id')
                        ->whereIn('categories.id',$request->input('category'))
                        ->get();*/
                $companies = User::whereHas('categories',function($q) use ($request){
                    $q->whereIn('categories.id',$request->input('category'));
                })->get();
        
       return view('display_list')->with(['companies'=>$companies]);
    }
}
