@extends('layouts.app')

@section('content')
<div class="container-fluid">
 @include('app_view.shared.search_cat_form')
    @include('app_view.shared.search')
    <button class="w3-btn w3-blue w3-margin-bottom" onclick="openMail('id02')">
                        Request Quotation
    </button>
    @if(count($companies) > 0)
        @foreach($companies->chunk(4) as $chunk )
        <div class="row w3-padding-left">
            @foreach ($chunk as $company)
                <div class="col-md-3 w3-margin-bottom" >
                    <div class="w3-card-2">
                    @if($company->galleries()->count() !== 0)
                                <img src="{{asset('storage/images/')}}/{{$company->galleries()->first()->image_name}}" alt="..." width="100%;"  id="img">
                                @else
                                <img src="{{asset('storage/images/default_event_image.jfif')}}" alt="No image" width="100%;" height=auto id="img">
                                @endif
                    <div class="caption" style= "padding:10px 0px 20px 10px;">
                        <h5>{{ $company->name }}(@foreach ($company->categories as $cat) <small>{{$cat->name}},</small>  @endforeach)</h5>
                        <div id ="address">
                            <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            {{$company->house_no}} {{$company->street_name}} {{$company->state}}</p>
                        </div>
                        <div>
                            @if($company->reviews->count() !== 0)
                                {{number_format($company->reviews->avg('rating'),1)}}/5 
                                from {{$company->reviews->count()}} reviews
                            @endif
                        </div>
                        <!--<small>Location: <span>{{$company->state}}</span></small>-->
                        <p>{{$company->summary}}</p>
                        <p><a href="{{url('detail/'.$company->name_slug)}}" class="w3-btn w3-blue" role="button">Details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
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
 @include('app_view.email_view_folders.quotation_form',['states'=>$states])
@endsection

@section('js')
    <script src="{{asset('/js/combox.js')}}"></script>
    <script src="{{asset('/js/formstep.js')}}"></script>
@endsection