@extends('layouts.app')

@section('customstyle')
<style>


    
    #Map {
        width: 100%;
        height: 400px;
    }

    fieldset { border:none; width:320px;}
    legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
    .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}

    .tabsContent{
        overflow-y:scroll;
        max-height:300px;
    }

    .well{
        overflow-y:scroll;
        max-height:500px;
    }

    #first_col{
        margin-left:10px;
    }
    
    .glyphicon-star{
       color:#DAA520;
    }

    .glyphicon-star-empty{
       color:#333;
    }


    .tabs{
        list-style-type: none;
    }

    .tabs >li{
        display: inline-block;
    }
    
</style>
@endsection


@section('headjs')

     <!--<script src="{{asset('/js/map.js')}}"></script>-->
    <script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaLwKhrrU0XnVwajC_lh_1nKX5hFBJ514">
    </script>



@endsection


@section('content')
<div class="container">
 <a href = "{{URL::previous()}}">
    <span class="glyphicon glyphicon-chevron-left">Back</span>
    <!--<button class="w3-btn w3-blue">Back</button>-->
 </a>
 
    @include('app_view.shared.search_cat_form')
    @include('app_view.shared.search')
 
@if(session('message'))
    <div class="alert alert-success container">
    <span class="w3-closebtn" onclick="this.parentElement.style.display='none'">X</span>
        {{ session('message') }}
    </div>
@endif
    <div class="row">
        <div class="col-md-6" id="first_col">
            <div class="w3-card-2 w3-margin">
                <header class="w3-container w3-black" onclick="myFunction('Demo1')">
                    <h3 id="company_name">{{$userd->name}}</h3>
                </header>
                <div id="Demo1" class="w3-animate-zoom w3-show">
                     @include('app_view.shared.gallery',['galleries'=>$userd->galleries])
                </div>
                    <div class="w3-padding-left w3-margin-top" id="allWrapper"><!--start-of-allWrapper-->
                        <p id ="address"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                        {{$userd->house_no}} {{$userd->street_name}} {{$userd->vicinity->name or ""}} {{$userd->state}}</p>

                   

                <!--<h2>Contact</h2>-->
                    <p><span class="glyphicon glyphicon-envelope"></span> {{$userd->email}}
                    <span class="glyphicon glyphicon-earphone"></span> <a href="tel:{{$userd->phone_no}}">{{$userd->phone_no}}</a></br>
                    @if(count($userd->offdays) > 0)
                      Not Available On
                      <div class="alert alert-success"> 
                        @foreach($userd->offdays as $offday)
                            <span class="date ">
                                <span class=" glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  
                                {{$offday->from_date->format('l jS \\of F Y').'--'.$offday->to_date->format('l jS \\of F Y')}}
                            </span>
                            @endforeach
                        </div>
                    @endif
                    </p>
                    <!--<button class="w3-btn w3-blue w3-margin-bottom" 
                        onclick="document.getElementById('id01').style.display='block'">
                        Send Mail
                    </button>-->
                    <button class="w3-btn w3-blue w3-margin-bottom" 
                        onclick="openMail('id01')">
                        Send Mail
                    </button>
            
                    <button class="w3-btn w3-blue w3-margin-bottom" onclick="openMail('id02')">
                        Request Quotation
                    </button>
                    @if(session('search_url'))<!-- this-is-search-url-that was performed before the review form was submitted-->
                       <a href = "{{session('search_url')}}">
                        <span class="glyphicon glyphicon-chevron-left">Back</span>
                        <!--<button class="w3-btn w3-blue">Back</button>-->
                    </a>
                    @else
                        <a href = "{{URL::previous()}}">
                        <span class="glyphicon glyphicon-chevron-left">Back</span>
                        <!--<button class="w3-btn w3-blue">Back</button>-->
                         </a>
                    @endif
                </div><!--end-of-allWrapper-->
            </div><!--w3-card-2-->
            
        </div><!--col-md-6-->
        <div class="col-md-5 offset-2">
            <div class="well w3-margin-top">
                <div>
                    @include('app_view.shared.tabs',['review_count'=>count($userd->reviews)])
                 <!--@include('app_view.tabscontent',['userd'=>$userd])-->
                </div>
                <div id = "Description" class="tabsContent">
                    <h4>Description</h4>
                    <p>@include('app_view.shared.show_description',['description'=>$userd->description])</p>
                </div><!-- id = Description-->

                <div id="Review" class="tabsContent">
                    <button class="w3-btn w3-blue w3-margin-top" onclick="document.getElementById('id03').style.display='block'">
                        Write a Review 
                    </button>
                    @include('app_view.shared.display_review',['reviews'=>$userd->reviews])
                   
                </div><!--id=Review-->

                <div id="Map" class="tabsContent">
                   <!-- <div id="map"></div>-->
                </div><!-- id=Map-->

            </div><!--well-->
        </div><!--col-md-5->
    </div>--><!--row-->
    <div class="row">
        <div class="col-md-10 w3-margin-left">
            <h5>Similar Companies</h5>
            @include('app_view.shared.partial_list_template',['companies'=>$similars])
        </div>

    </div>

    <div class="row" style="padding-top:10px;">
        <div class="col-md-6">
            @include('app_view.email_view_folders.email_form')
        </div>

        <div class="col-md-6">
            @include('app_view.email_view_folders.quotation_form',['states'=>$states])
        </div>

        <div class="col-md-4">
            @include('app_view.shared.review_form')
        </div>
    </div>
</div><!--container-->
@endsection

@section('js')
    <script src="{{asset('/slick/slick.min.js')}}"></script>
    <script src="{{asset('/js/jqueries.js')}}"></script>
    <script src="{{asset('/js/formstep.js')}}"></script>
    <script src="{{asset('/js/combox.js')}}"></script>
@endsection