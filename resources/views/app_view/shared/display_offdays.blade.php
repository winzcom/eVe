 
            @foreach($offdays as $offday )
                <div class="w3-card-3">
                    <li class="list-group-item w3-card-3 li" data-date = "{{$offday->id}}"> 
                      <span class=" glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  
                      <span class="date">{{$offday->from_date->format('l jS \\of F Y')}}-
                      
                       @if($offday->to_date !== null){{$offday->to_date->format('l jS \\of F Y')}} @endif</span>
                      <button class="remove_off_day"><span class=" glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                    </li>
                <div><!-- card-->
            @endforeach
