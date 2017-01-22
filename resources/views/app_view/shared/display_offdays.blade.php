 <ul class="list-group">
            @foreach($offdays as $offday )
                <div class="w3-card-3">
                    <li class="list-group-item w3-card-3"> 
                      <span class=" glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  
                      {{$offday->offday->format('l jS \\of F Y')}} 
                      <span class=" glyphicon glyphicon-cancel" aria-hidden="true"></span> 
                    </li>
                <div><!-- card-->
            @endforeach
        </ul>
