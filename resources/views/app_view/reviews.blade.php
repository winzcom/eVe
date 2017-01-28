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
<?php $j = 1;?>
    <div class="container-fluid">
        <div class="table-responsive">
            @if($reviews->count() > 0)
                @include('app_view.shared.review_filter_tab',['total'=>$total,'avg'=>$avg])

               <table  class="table table-striped  table-bordered table-hover">
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
                                       
                                       
                                        $num = ((int)($page*$pagination)-$pagination+$j);
                                        
                                        ++$j;
                                        echo $num;
                                        
                                    }
                                    else echo $j++;
                                ?>
                            </td>
                            <td>{{$review->reviewers_name}} 
                                <small>
                                    <i>
                                        <a href="#" class="review_reply" data-name = "{{$review->reviewers_name}}" data-id="{{$review->id}}">
                                            reply
                                        </a>
                                    </i>
                                </small>
                            </td>
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

    <script src="{{asset('/js/jqueries.js')}}"></script>

    <script>
        
    </script>
@endsection