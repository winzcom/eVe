@extends('layouts.app')

@section('content')

<?php $i = 0;?>
<?php $j = 0;?>
    <div class="container-fluid">
        <div class="w3-cards-3">
            @if($reviews->count() > 0)
                
                @include('app_view.shared.tabs',['review_count'=>$reviews->count()])
                
                
                <div id="positives" class="tabsContent">

                    <table  class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewers Name</th>
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                        </tr>
                    
                    @foreach($positives as $key=>$review)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$review->reviewers_name}}</td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div><!--positives-->


                <div id="negatives" class="tabsContent">

                    <table  class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewers Name</th>
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                        </tr>
                    
                    @foreach($negatives as $key=>$review)
                       
                        <tr>
                            <td>{{++$j}}</td>
                            <td>{{$review->reviewers_name}}</td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div><!--negatives-->
                
            @endif
        </div>
        
    </div>

@endsection

@section('js')
    
    <script src="{{asset('/js/combox.js')}}"></script>
@endsection