<?php 
namespace App\Reponsitories;

use App\Models\Chat;
use App\Models\Typing;
use Illuminate\Support\Facades\Auth;
class TypingsReponsitory extends AbstracRiponsitory{

    public function getModel(){

        return Typing::class;
    }
    public function authid(){
        return Auth::id();}
    public function updateCheckstatus($chats){
        $this->model->where('recever',$chat->recever)
                    ->where('sender', $chat->sender)
                    ->update(['check_status' => 0]);
    }
    public function typing_check($id){
        return $this->model->where('recever',$id)
                            ->where('sender',$this->authid())
                            ->first();
    }
    public function updateTypings($id,$text){

        return $this->model->where('recever',$id)
                    ->where('sender',$this->authid())
                    ->update(['check_status' => $text]);
    }
    public function saveTypings($id,$text){
        return $this->model->create([
            'sender' => $id,
            'recever' => $this->authid(),
            'check_status'=> $text,
        ]);
        }
    public function typinc_receve($id){
        return $this->model->where('recever',$this->authid())
                            ->where('sender',$id)
                            ->first();
    }
   
}