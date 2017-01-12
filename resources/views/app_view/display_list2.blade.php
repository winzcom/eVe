@extends('layouts.app')

@section('customstyle')

<style>
    .li{
        border:none; 
        border-left:solid #669999;
        border-radius:0px;
        margin:5px 5px 5px 5px;
    }
</style>
@endsection


@section('content')
    <div class="container">
     @include('app_view.shared.search_cat_form')
     @include('app_view.shared.search')
     
    @if(count($companies) > 0)
       </select></span>
       @include('app_view.shared.partial_list_template',['companies'=>$companies])
       {{ $companies->appends($request->query->all())->links() }}

    @else

    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class = "panel-body">
            <h3>No Result Available for Search Criteria</h3>
            <a href="{{url('/')}}"><button class="btn btn-default">Back</button></a>
        </div>
    </div>
</div>
@endif
@endsection

@section('js')
    <script src="{{asset('/js/combox.js')}}"></script>
@endsection