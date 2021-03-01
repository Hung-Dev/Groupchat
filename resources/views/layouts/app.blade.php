<?php
$recever=Route::input('id');	
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secret chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script> 
 setInterval(seenMessage,1000); 
 setInterval(allMessageView,1000); 

function seenMessage() {
   

    $.ajax({
        type:'get',
        url:'{{URL::to('/seen')}}',
        datatype:'html',
        success:function(response){
            
            if(response > 0){
                $('#smsnum').show();
                $('#smsnum').html(response);

            }else{
                $('#smsnum').hide();
            }
             
           }
        });
}
function allMessageView() {
   

    $.ajax({
        type:'get',
        url:'{{URL::to('/allmessageview')}}',
        datatype:'html',
        success:function(response){
           $('#all-chat-message').html(response);
           }
        });
}

function seenUpdate() {

    $.ajax({
        type:'get',
        url:'{{URL::to('/seenUpdate')}}',
        datatype:'html'
        });
}
function singleSeenUpdate(id) {
 var sender=id;
    $.ajax({
        type:'get',
        url:'{{URL::to('/singleSeenUpdate')}}/'+sender,
        datatype:'html'
        });
}

</script>

</head>

<body>
<input type="hidden"id="sound_check">
<audio id="audio" src="https://notificationsounds.com/soundfiles/a86c450b76fb8c371afead6410d55534/file-sounds-1108-slow-spring-board.mp3" ></audio>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                      SecretMessage
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>




</body>
</html>
