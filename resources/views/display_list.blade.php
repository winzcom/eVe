@extends('layouts.app')

@section('content')
    
    @foreach($companies->chunk(3) as $chunk )
    <div class="row">
        @foreach ($chunk as $company)
            <div class="col-lg-4">
            <div class="thumbnail">
            <img src="./images/event.jpeg" alt="...">
            <div class="caption">
                <h3>{{ $company->CN }}</h3>
                <p>{{$company->DE}}}</p>
                <p><a href="{{url('detail/'.$company->NS)}}" class="btn btn-primary" role="button">Details</a></p>
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