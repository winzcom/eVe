
<?php 
     
     $request_categories = Request::query('category');
     $request_states = Request::query('state');
?>
<div class="w3-margin-bottom">
    <form method = "get" action = "{{url('/search')}}" class="form-inline" >
                            {{ csrf_field() }}
                            <div class="input-group">
                                <!--<label for="Category" class="cat">Categories</label>-->
                                <span class="input-group-addon">Categories</span>
                                <select  multiple="true" placeholder = "Select Categories"
                                class="form-control  cc chzn-select" id="combobox" name="category[]" selected ="{{old('category')}}"  required>
                                    <option></option>
                                        

                                            @foreach ($category as $key=>$cate)

                                            
                                                <option value = "{{$cate->id}}"

                                                        <?php 
                                                            if(!is_null($request_categories)){
                                                                    if(in_array($cate->id,$request_categories))
                                                                    echo 'selected';
                                                            }

                                                        ?>
                                                >{{$cate->name}}</option>;
                                            @endforeach
                                        
                                    </select>
                                </div>
                                <div class="input-group">
                                <!-- <label for="Category" class="cat">States</label>-->
                                    <span class="input-group-addon">State</span>
                                    <select placeholder = "Select State" class="form-control cc " id="combobox" name="state"  required>
                                    <option value = "all">All</option>
                                    @foreach($states as $state)
                                        <option value= "{{$state->state}}"
                                        
                                            <?php 
                                            if( !is_null($request_categories))
                                                        if($state->state == $request_states)
                                                            echo 'selected';
                                                    ?>

                                        >{{$state->state}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <input type = "submit" class="btn btn-primary" value="search"/>
                            </div>
    </form>
</div>