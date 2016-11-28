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

                        @foreach($formInputs as $input)
                            <div class="form-group{{ $errors->has($input) ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ucwords(str_replace('_',' ',$input))}}</label>

                            <div class="col-md-6">
                                @if($input == 'password' || $input == 'password_confirm')
                                <input id="name" type="password" class="form-control" name="{{$input}}" value="{{ old($input) }}" required autofocus>
                                @elseif ($input == 'description')
                                <textarea rows="4" cols="50" value = "{{old($input)}}" name = "{{$input}}"></textarea>
                                @elseif($input == 'category')
                                <select  multiple ="true" class="form-control chzn-select" id="combobox" name="category[]"  required>
                                    <option></option>
                                    @foreach ($categories as $cate)
                                    <option value = "{{$cate->id}}">{{$cate->name}}</option>
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

                       <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
</script>
@endsection
