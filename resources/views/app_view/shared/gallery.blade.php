
<!--<div class="w3-panel w3-light-grey">
<h4>Gallery</h4>-->

@if(count($galleries) == 0)
<div class="alert alert-success">No gallery Available</div>
@else
    <div class="slick-carousel">
             @foreach($galleries as $gallery)
                        

                            <!--<div class="col-md-3">
                                <div class="w3-card-2 w3-hover-shadow" style="padding-left:0px;">-->
                                    <div>
                                        <img src="{{$path}}/{{$gallery->image_name}}" width="100%"/>
                                        <p class="w3-margin">
                                            
                                            @if($gallery->caption !== null)
                                                {{html_entity_decode($gallery->caption)}}
                                            @endif
                                        </p>
                                    </div>
                                       
                                    
                                <!--</div>-->
                            <!--</div>--><!-- col-md-3-->
                        
                       @endforeach
    </div><!-- slick-carousel-->

@endif
                   
<!--</div>-->