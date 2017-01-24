@extends('layouts.app')

@section('customstyle')

<style>
    .filter{
        display:inline;
        
    }
    .filter_active{
        background-color:black;
        color:white;
        text-decoration:none;
    }

    .glyphicon-star{
       color:#DAA520;
    }
    
</style>

@endsection

@section('content')

<?php $i = 0;?>
<?php $j = 0;?>
    <div class="container-fluid">
        <div class="w3-cards-3">
            @if($reviews->count() > 0)
                @include('app_view.shared.review_filter_tab',['total'=>$total,'avg'=>$avg])

               <table  class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewer's Name</th>
                            <th>Reviewer's Email</th>
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                        </tr>
                    
                    @foreach($reviews as $key=>$review)
                        <tr>
                            <td>
                                <?php 
                               
                                    if($page !== null && $page !== '1'){
                                        ++$j;
                                        $num = (int)($page*$pagination)-$pagination+$j;
                                        echo $num;
                                        
                                    }
                                    else echo ++$j;
                                ?>
                            </td>
                            <td>{{$review->reviewers_name}}</td>
                            <td>{{$review->reviewers_email}}</td>
                            <td  width="8%">
                                <?php 
                                
                                $count = $review->rating;
                                for($i=0;$i<$count;$i++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star"></span>';
                             
                                }            
                    ?>
                            </td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                        </tr>
                    @endforeach
                    </table>
                
                
                
                {{$reviews->links()}}

            @else
               @include('app_view.shared.review_filter_tab')
                <div class="alert alert-success">No Reviews</div>
            @endif
        </div>
        
    </div>

@endsection

@section('js')
    
    <script src="{{asset('/js/combox.js')}}"></script>
@endsection