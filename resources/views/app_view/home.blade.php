@extends('layouts.app')

@section('customstyle')
<style>
    .line{
        border-bottom:dotted 1px black;
    }
</style>

@endsection

@section('content')

        <!-- Page Content -->
<div class="container-fluid">
@if(session('message'))
    <div class="alert alert-success">
    <span class="w3-closebtn" onclick="this.parentElement.style.display='none'">X</span>
        {{ session('message') }}
    </div>
@endif
    
   <div class="row">
    <div class="col-md-4">
        <div class="w3-card-2 w3-margin-left">
            <div class="w3-accordion ">
                <header class="w3-container w3-black" onclick="myFunction('Demo1')">
                        <h4>Details</h4>
                </header>
                <!--<div id="Demo1" class="w3-accordion-content w3-animate-zoom w3-show">
                    <img src="{{asset('images/tl.jpg')}}" width="100%">
                </div>-->
            </div>

            <div id ="address" style="margin-top:10px; margin-left:10px;">
                <p class="line"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                {{Auth::user()->house_no}} {{Auth::user()->street_name}} {{Auth::user()->state}}</p>

                <h4>Full Name: </h4>
                <p class="line">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>

                <h4><span class="glyphicon glyphicon-envelope"></span></h4>
                <p class="line">{{Auth::user()->email}} </p>

                <h4><span class="glyphicon glyphicon-earphone"></span></h4>
                <p class="line">{{Auth::user()->phone_no}}</p>

                <h4>Description</h4>
                <p>{{Auth::user()->description}}</p>
            </div>

            <!--<div style="margin-left:5px;">
                <h4>Address</h4>
                    <small>State: {{Auth::user()->state}} |</small>
                    <small>Street: {{Auth::user()->street_name}} |</small>
                    <small>House Number: {{Auth::user()->house_no}} </small>
                <h4>Description</h4>
                <p>{{Auth::user()->description}}</p>
            </div>-->
        </div>
    </div><!-- col-md-company-logo-->
    <div class="col-md-6">
        <div class="w3-card-4 w3-margin-left">
            <header class="container-fluid w3-black w3-margin-bottom "><h4>Gallery</h4></header>
                        <!--<div class=" slick-carousel">
                        @foreach($user->galleries as $gallery)
                            <div class="">
                                <div class="w3-card-2">
                                    
                                    <img src= "{{$path}}/{{$gallery->image_name}}" width="100%">
                                </div>-->
                           <!-- </div>--><!-- col-md-3-->
                        
                       <!--@endforeach
                      </div>--><!-- slick-->
                      @include('app_view.shared.gallery',['galleries'=>$user->galleries()->get()])
        </div>
        <div class="w3-card w3-margin w3-padding">
        
          <header class="w3-margin w3-container">
            @include('app_view.shared.tabs',['review_count'=>$user->reviews()->count()])
          </header>

               
            <div id="reviews" class="tabsContent">

                @if($user->reviews()->count() == 0)
                <h4>
                    No Reviews
                </h4>
                @else
                    @include('app_view.shared.display_review',['reviews'=>$user->reviews()->take(5)])
                @endif
            </div><!--Reviews-->

            <div id="quotations" class="tabsContent">
                <h4>
                    No Quotations
                </h4>
            </div><!--quotation-->
    
        </div>
    </div><!-- col-md-gallery-address-->

   </div>
</div>     
@endsection

@section('js')
    <script src="{{asset('/slick/slick.min.js')}}"></script>
    <script src="{{asset('/js/combox.js')}}"></script>
    <!--<script src="{{asset('/js/jqueries.js')}}"></script>-->
    <script type="text/javascript">

        $(document).ready(function(){

           // $(".chzn-select").chosen()

            /*$('#accordion').accordion({
                collapsible: true
            })*/

            $('.slick-carousel').slick({
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows:true,
            });
    });



  </script>
@endsection