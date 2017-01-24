<!--<div id="positives" class="tabsContent">

                    <table  class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewer's Name</th>
                            <th>Reviewer's Email</th>
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                        </tr>
                    
                   // @foreach($positives as $key=>$review)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$review->reviewers_name}}</td>
                            <td>{{$review->reviewers_email}}</td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                        </tr>
                    @endforeach
                    </table>
                     
                </div>--><!--positives-->


               <!-- <div id="negatives" class="tabsContent">

                    <table  class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>Reviewer's Name</th>
                            <th>Reviewer's Email</th>
                            <th>Rating</th>
                            <th>Review Date</th> 
                            <th>Review</th>
                        </tr>
                    
                    @foreach($negatives as $key=>$review)
                       
                        <tr>
                            <td>{{++$j}}</td>
                            <td>{{$review->reviewers_name}}</td>
                            <td>{{$review->reviewers_email}}</td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->created_at->toFormattedDateString()}}</td> 
                            <td>{{$review->review}}</td>
                        </tr>
                    @endforeach
                    </table>
                     
                </div>--><!--negatives-->