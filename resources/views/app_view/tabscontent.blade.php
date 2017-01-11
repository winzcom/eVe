<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="Description">
        <h4>Description</h4>
        <p>{{$userd->description}}</p>
    </div>
    <div role="tabpanel" class="tab-pane" id="map"></div>
    <div role="tabpanel" class="tab-pane" id="Review">
        <h3>John Bens</h3>
            <?php 
                $array = array(true,true,true,false);
                foreach($array as $vl){
                    if($vl)
                        echo  '<span class="glyphicon glyphicon-star"></span>';
                    else
                        echo  '<span class="glyphicon glyphicon-star-empty"></span>';
                }
                    
            ?>
            <p>Good service by ePlanning they offer great service</br> 
                and were very professional in their conduct 
            </p>
        </div>
  </div>