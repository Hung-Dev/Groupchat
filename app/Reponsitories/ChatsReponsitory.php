<?php
 
namespace App\Reponsitories;

use App\Models\Chat;
use App\Models\Typing;
use Illuminate\Support\Facades\Auth;

class ChatsReponsitory extends AbstracRiponsitory{

    public function authid(){
        return Auth::id();}
    
    public function getModel(){

        return Chat::class;
    }
    public function saveChats($request){
        $this->model->create([
            'message' => $request->message,
            'sender' => $request->sender,
            'recever'=> $request->recever,
        ]);
    }
    public function soundCheck(){
        return $this->model->where('recever',$this->authid())
                            ->get()
                            ->count();
    }
    public function seenMessage(){
        return $this->model->where('recever',$this->authid())
                            ->where('is_seen',1)
                            ->get()
                            ->count();    
    }
    public function seenUpdate(){
        return $this->model->where('recever',$this->authid())
                            ->where('is_seen',1)
                            ->update(['is_seen' => 0]);
    }
    public function singleSeenUpdate($id){
        return $this->model->where('recever',$this->authid())
                    ->where('is_user_seen',1)
                    ->where('sender',$id)
                    ->update(['is_user_seen' => 0]);
        return $this->model->where('recever',$this->authid())
                    ->where('is_seen',1)
                    ->where('sender',$id)
                    ->update(['is_seen' => 0]);
    }
    public function deletemessage($id){
       return $this->model->where('id',$id)
                        ->delete();
    }
    public function getMessBySender($id){
        return $this->model->where('recever',$this->authid())
                            ->where('sender',$user->id)
                            ->orderBy('id','desc')
                            ->first();
    }
    public function getMessByIsuserseen($id){
        return $this->model->where('recever',$this->authid())
                            ->where('sender',$user->id)
                            ->where('is_user_seen',1)
                            ->get()
                            ->count();  
    }
}