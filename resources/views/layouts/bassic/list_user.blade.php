@extends('layouts.app')

@section('content')
<div id="wrapper">
   <div id="menu">
        <p class="welcome">Welcome <b></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>
    <div style="width: 400px">
        <h2>Danh sách người dùng</h2>
        @foreach($users as $user)
            <a href="see/{{{$user->id}}}">{{ $user->username }}</a><br>
        @endforeach
    
    </div>
     <center>
        <div id="chatbox" style="text-align:left;
        margin-bottom:25px;
        padding:10px;
        background:#fff;
        height:270px;
        width:430px;
        border:1px solid #ACD8F0;
        overflow:auto;
        margin-top: -200px"></div>
        
        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </form>
     </center>
   
</div>
@endsection