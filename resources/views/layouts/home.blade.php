@extends('layouts.app')

@section('content')

         <div class="container">   
            <div class="jumbotron" style="width:1000px;height:300px;">
                @include('app_view.shared.gallery')
            </div>
        </div>

        <div class="container-fluid">
            @include('app_view.shared.tabs')
        </div>
@endsection

@section('js')
    <script src="{{asset('/slick/slick.min.js')}}"></script>
    <script src="{{asset('/js/combox.js')}}"></script>
     <script src="{{asset('/js/jqueries.js')}}"></script>
    <script type="text/javascript">


  </script>
@endsection