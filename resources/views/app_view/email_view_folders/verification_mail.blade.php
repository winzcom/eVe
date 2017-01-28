<div>

    Hello {{$user->first_name}} {{$user->last_name}}
    Please click the link to verify your account

    {{URL::to('register/verify/'.$user->confirm_token)}}
</div>