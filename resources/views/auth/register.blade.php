@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div id="accordion">
                        @foreach($formInputs as $key => $val)
                            <h3 style="background-color:#333;padding:5px 5px 5px 5px; color:white;" class="container-fluid">{{$key}}</h3>
                            <div>
                            @foreach($val as $input)
                            <div class="form-group{{ $errors->has($input) ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ucwords(str_replace('_',' ',$input))}}</label>

                            <div class="col-md-6">
                                @if($input == 'password' || $input == 'password_confirm')
                                <input id="name" type="password" class="form-control" name="{{$input}}" value="{{ old($input) }}" required autofocus>
                                @elseif ($input == 'description')
                                <textarea rows="4" cols="50" value = "" name = "{{$input}}">{{old($input)}}</textarea>
                                @elseif($input == 'category')
                                <select  multiple ="true" class="form-control chzn-select" id="combobox" name="category[]"  required>
                                    <option></option>
                                    @foreach ($categories as $cate)
                                    <option value = "{{$cate->id}}">{{$cate->name}}</option>
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
                                        <?php if(old($input) == $state->state) echo 'selected';?>
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
                                                >{{$vicinity->name}}</option>
                                                @endforeach
                                </select>

                                @else
                                <input id="name" type="text" class="form-control" name="{{$input}}" value="{{ old($input) }}" required autofocus>
                                @endif
                                @if ($errors->has($input))
                                    <span class="help-block">
                                        <strong>{{ $errors->first($input) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        </div>
                        @endforeach
                        </div><!--Accordion-->
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                        </div>
                    </form>
                </div><!--Panel body-->
            </div><!--Panel default-->
        </div><!--col-md-8 col-md-offset-2-->
    </div><!--row-->
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
           // $('#accordion').steps();

    });



  </script>
@endsection