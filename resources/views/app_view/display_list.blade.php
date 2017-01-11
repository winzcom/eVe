@extends('layouts.app')

@section('content')
    
    @if(count($companies) > 0)
        @foreach($companies->chunk(6) as $chunk )
        <div class="row">
            @foreach ($chunk as $company)
                <div class="col-md-2" >
                <div class="w3-card-2">
                    <img class = "w3-hover-shadow" src="./images/bee.jpg" alt="..." width="100%">
                    <div class="caption" style= "padding:10px 0px 20px 10px;">
                        <h3>{{ $company->name }}(@foreach ($company->categories as $cat) <small>{{$cat->name}},</small>  @endforeach)</h3>
                        <div id ="address">
                            <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            {{$company->house_no}} {{$company->street_name}} {{$company->state}}</p>
                        </div>
                        <!--<small>Location: <span>{{$company->state}}</span></small>-->
                        <p>{{str_limit($company->description,100)}}</p>
                        <p><a href="{{url('detail/'.$company->name_slug)}}" class="w3-btn w3-blue" role="button">Details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    @else
<div class="container">
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