<span>{{number_format($reviews->avg('rating'),1)}}/5<span>
                    @foreach($reviews->orderBy('id','desc')->get() as $review)
                        <h4>
                            {{$review->reviewers_name}} 
                            
                        </h4><span><?php 
                                $array = array(true,true,true,false);
                                $count = $review->rating;
                                for($i=0;$i<$count;$i++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star"></span>';
                             
                                }

                                if($count<5){
                                    for($j=0;$j<5-$count;$j++){
                                        
                                            echo  '<span class="glyphicon glyphicon-star-empty"></span>';
                             
                                     }
                                }
                            
                    ?></span> &nbsp;@if($review->created_at !== null){{$review->created_at->toFormattedDateString()}}@endif
                        <p>{{$review->review}}</p>
                    @endforeach