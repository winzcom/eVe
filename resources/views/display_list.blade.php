@extends('layouts.app')

@section('content')
    <div>
    @foreach($companies as $company )
        <h1>{{$company->CN}}</h1>
        <p>{{$company->CE}}</p>
    @endforeach
    </div>
@endsection