@extends('layouts.app')

@section('content')
    
    @foreach($companies->chunk(3) as $chunk )
    <div class="row">
        @foreach ($chunk as $company)
            <div class="col-lg-4">
            <div class="thumbnail">
            <img src="./images/event.jpeg" alt="...">
            <div class="caption">
                <h3>{{ $company->name }}(@foreach ($company->categories as $cat) <small>{{$cat->name}},</small>  @endforeach)</h3>
                <p>{{$company->description}}}</p>
                <p><a href="{{url('detail/'.$company->name_slug)}}" class="btn btn-primary" role="button">Details</a></p>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
    

<div class="row">
  <div class="col-sm-6 col-md-4">
    
    </div>
  </div>
</div>

@endsection