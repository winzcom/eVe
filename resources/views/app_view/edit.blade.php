@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                <div class="w3-card w3-padding">
                    {{Form::model($user,['url'=>"profile/edit"])}}
                        {{ csrf_field() }}
                        <div id="accordion">
                            @foreach($formInputs as $key=>$val)
                               <h3 style="background-color:#333;padding:5px 5px 5px 5px; color:white;" class="container-fluid">{{$key}}</h3>
                                    <div>
                                        @foreach($val as $input)
                                        <div class="form-group{{ $errors->has($input) ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ucwords(str_replace('_',' ',$input))}}</label>
                                        @if($input == 'password' || $input == 'password_confirm')
                                        
                                            <div class="form-group form-group-md">

                                                {{Form::password($input,['class'=>'form-control','required'])}}
                                            </div>
                                        @elseif($input == 'category')
                                        
                                            <select  multiple ="true" class="form-control chzn-select" id="combobox" name="category[]"  required>
                                                    <option></option>
                                                    @foreach ($categories as $cate)
                                                        <option value = "{{$cate->id}}" <?php 
                                                            if($user->categories->contains($cate->id))
                                                            echo 'selected'
                                                        ?>>
                                                            {{$cate->name}}
                                                        </option>
                                                    @endforeach
                                            </select>

                                        @elseif($input == 'state')
                                            <select   class="form-control chzn-select" id="state" name="state" 
                                                onchange = "changeVicinitySelect(this)"
                                                
                                                required>
                                                <option></option>
                                                @foreach ($states as $state)
                                                <option value = "{{$state->state}}"
                                                    data-id = "{{$state->id}}"
                                                    <?php if($user->state == $state->state) echo 'selected';?>
                                                >{{$state->state}}</option>
                                                @endforeach
                                            </select>

                                    @elseif($input == 'vicinity_id')
                                        <select   class="form-control" id="vicinity" name="vicinity_id">
                                                <option></option>
                                                @foreach ($vicinities as $vicinity)
                                                <option value = "{{$vicinity->id}}"
                                                    data-state-id = "{{$vicinity->state_id}}"
                                                     class="vicinities"
                                                    <?php if($user->vicinity_id == $vicinity->id) echo 'selected';?>
                                                >{{$vicinity->name}}</option>
                                                @endforeach
                                            </select>

                                    @elseif ($input == 'description')
                                        {{Form::textarea($input,$user->$input,['class'=>'form-control','required'])}}

                                    @elseif($input == 'email')
                                        <div class="form-group form-group-md">
                                            {{Form::email($input,$user->email,['class'=>'form-control','required'])}}
                                        </div>
                                    @else
                                        <div class="form-group form-group-md">
                                            {{Form::text($input,$user->$input,['class'=>'form-control'])}}
                                        </div>
                                    @endif
                                    @if ($errors->has($input))
                                        <span class="help-block">
                                            <strong>{{ $errors->first($input) }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div><!-- Accordion-->
                     <div class="form-group form-group-md">
                        {{Form::submit('submit',['class'=>'btn btn-primary'])}}
                    </div>
                {{Form::close()}}
            </div><!--well-->
                
            </div><!--col-xs-4-->
</div><!-- row-->
</div><!--container-->
@endsection

@section('js')
    <script src="{{asset('/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('/js/combox.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $(".chzn-select").chosen();
            /*$('#accordion').accordion({
                collapsible: true
            })*/

    });



  </script>
@endsection