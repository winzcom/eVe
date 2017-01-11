<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eWeb') }}</title>

    <!-- Styles -->
   <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link href="./simple-sidebar.css">

       <!-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('/css/w3.css')}}">
        <link rel="stylesheet" href="{{asset('/css/my_style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/chosen.css')}}">
        <!--<link rel="stylesheet" href="{{asset('/css/chosen.min.css')}}">-->
        <link rel="stylesheet" href="{{asset('/slick/slick.css')}}">
         <link rel="stylesheet" href="{{asset('/slick/theme/slick-theme.css')}}">

    <!-- Scripts -->
       <!--<scritp src=" https://unpkg.com/vue@2.1.6/dist/vue.js"></script>-->
       <script src="{{asset('/js/app.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
       <script src="{{asset('/js/jquery.steps.js')}}"></script>
        
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>-->
        

        <!--<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
   </script>-->


   
   <style>
   /*body{background-color:#fff;}
   .cat{
       color:#fff;
   }*/
  /* #img{
        -webkit-transition: width 1s;
        transition: width 1s ;
   }

   #img:hover{
       width:300px; height:auto;
       transition-timing-function: ease;
   }*/
   </style>

   @yield('customstyle')

</head>
<body>

    @yield('headjs')
    <div id="app">
        <nav class="navbar navbar-inverse" style="background-color:#669999;border:none;">
            <div class="container-fluid w3-padding-left w3-padding-top" >
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                   <!-- @if(URL::previous() !== null)
                    <a href="{{URL::previous()}}"><span class="navbar-brand glyphicon glyphicon-arrow-left"></span></a>
                    @endif-->
                    <a class="navbar-brand cat" href="{{ url('/') }}" style="color:#fff;">
                        {{ config('app.name', 'eWeb') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                       @if (Auth::user())
                            @include('app_view.shared.side_menu')
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li style=""><a style="color:#fff;" href="{{ url('/login') }}" class="cat">Login</a></li>
                            <li><a style="color:#fff;" href="{{ url('/register') }}" >Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href='{{url("/detail/")}}/{{Auth::user()->name_slug}}' style="color:#fff;">
                                    {{ Auth::user()->name }} <!--<span class="caret"></span>-->
                                </a>
                                <!--<ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>-->

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                   <!-- </li>
                                </ul>
                            </li>-->

                            <li>
                                <a href="{{ url('/logout') }}" style="color:#fff;"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                Logout
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    <!-- Scripts -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>-->

    @yield('js')
    <script src="{{asset('/js/chosen.jquery.js')}}"></script>
        <script>
            /*if('serviceWorker' in navigator){
                navigator.serviceWorker.register('sw.js').then(function(){
                    console.log('Service worker Registered');
                })
            }*/

            $(".chzn-select").chosen();
        </script>
</body>
</html>
