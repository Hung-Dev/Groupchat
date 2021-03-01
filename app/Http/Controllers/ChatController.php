<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\Typing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use URL;
use Illuminate\Support\Str;
use App\Reponsitories\ChatsReponsitory;
use App\Reponsitories\TypingsReponsitory;
use App\Reponsitories\UsersReponsitory;
use Illuminate\Support\Facades\Route;

class ChatController extends Controller
{
    protected $ChatsRepo;
    public function __construct(ChatsReponsitory $ChatsReponsitory,
                                TypingsReponsitory $TypingsReponsitory,
                                UsersReponsitory $UsersReponsitory
                                                                        ){

        $this->ChatsRepo = $ChatsReponsitory;
        $this->TypingRepo = $TypingsReponsitory;
        $this->UsersRepo = $UsersReponsitory;
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){
        $chats = $this->ChatsRepo->saveChats($request);
        return $chats;
        $typing = $this->TypingRepo->updateCheckstatus($chats);
        return back();
    }
    function callmessage($id){
        $user = $this->UsersRepo->getByIdUser($id);
        $user->first_name;
        $auth_id=Auth::id();
        $chats = chat::where('sender',$auth_id)
                     ->where('recever',$id)
                     ->Orwhere('sender',$id)
                     ->where('recever',$auth_id)
                     ->get();
        foreach($chats as $chat){
            if($chat->sender != $auth_id){
echo '<li class="left clearfix"><span class="chat-img pull-left">
<img src="http://placehold.it/50/55C1E7/fff&text='. mb_substr($user->first_name , 0, 1) .' " alt="User Avatar" class="img-circle" />
</span>
<div class="chat-body clearfix">
    <div class="header">
        <strong class="primary-font">'.$user->first_name  . '</strong> <small class="pull-right text-muted">
            <span class="glyphicon glyphicon-time"></span>' . $chat->created_at->diffForHumans() .'</small>
    </div>
    <div class="alert alert-success ">
    '. $chat->message .' </div>
                  </div>
                  </li>';
            }else{
                echo '<li id="'.$chat->id.'" class="right clearfix"><span class="chat-img pull-right">
                <img src="http://placehold.it/50/FA6F57/fff&text='. mb_substr(Auth::user()->first_name , 0, 1) .'" alt="User Avatar" class="img-circle" />
            </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'. $chat->created_at->diffForHumans() .'</small>
                        <strong class="pull-right primary-font">'.Auth::user()->first_name  .'</strong>
                    </div>
                    <div class="alert alert-info ">
  <span onclick="deleteMessage('.$chat->id.')" class="close"  aria-label="close">&times;</span>'. $chat->message .' </div>
                </div>
                </li>';
            }
        };
    }
    public function soundCheck(){
        $chats = $this->ChatsRepo->soundCheck();
        print_r($chats );
    }
    public function seenMessage(){
        $chats = $this->ChatsRepo->seenMessage(); 
        print_r($chats );
    }
    public function seenUpdate(){
        $chats = $this->ChatsRepo->seenUpdate();    
    }
    public function singleSeenUpdate($id){
        $chats = $this->ChatsRepo->singleSeenUpdate($id);   
    }
    public function typing(Request $request){
        $id=$request->recever;
        $text= $request->text;
        $chats = $this->ChatsRepo->singleSeenUpdate($id);
        $typing_check = $this->TypingRepo->typing_check($id);
        if($typing_check){
            $this->TypingRepo->updateTypings($id,$text);
        }else{
            $this->TypingRepo->saveTypings($id,$text);
        }
    }
    public function deletemessage($id){
        $deletemessage = $this->ChatsRepo->deletemessage($id);
    }
   public function typinc_receve($id){
        $typing_receve = $this->TypingRepo->typinc_receve($id);
           if(isset( $typing_receve)){
               return  $typing_receve->check_status;
           }            

   }
    public function allMessageView(){
        $url=URL::to('/message/');
        $users = $this->UsersRepo->getLists();
        return $users;
        foreach($users as $user){
            if(Auth::id()!=$user->id){  
                $message = $this->ChatsRepo->getMessBySender($id);
                $msgcount = $this->ChatsRepo->getMessByIsuserseen($id);                  
                if($msgcount>0){
                    $msg="(". $msgcount  .")";
                    $start_b='<b>';
                    $end_b='</b>';
                }else{
                    $msg="";
                    $start_b='';
                    $end_b='';
                }
              if(isset($message)){
            $srtmessage=Str::limit($message->message, 40);
                echo '
                <a onclick="singleSeenUpdate('.$user->id.')" href="'.$url.'/'.$user->id.'"> 
                <li class="left clearfix">
                        <span class="chat-img pull-left">
                        <img alt="User Avatar" class="img-circle" src="http://placehold.it/25/55C1E7/fff&amp;text=U"></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                             <strong class="primary-font">' . $user->first_name . $msg .'</strong>
                             <p style="color:black">
                             
                            '. $start_b . $srtmessage .$end_b.'
                              
                             </p>
                            </div>
                        
                        </div>
                    </li>                   
                </a>
                ';
              }
          
            }
        }
    
    }
}
