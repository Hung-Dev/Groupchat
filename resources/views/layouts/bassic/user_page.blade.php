@extends('layouts.app')

@section('content')

@foreach($users as $user)

<div id="wrapper">
   <div id="menu">
        <p class="welcome">Welcome to {{$user->username}} message class<b></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>
    <div style="">
    </div>
     <center>
        <div id="chatbox" style="text-align:left;
        margin-bottom:25px;
        padding:10px;
        background:#fff;
        height:270px;
        width:430px;
        border:1px solid #ACD8F0;
        overflow:auto;"></div>
        
        <form name="message" action="{{ route('see.store') }}">
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </form>
     </center>
   
</div>

@endforeach



@endsection

