<?php
 
namespace App\Reponsitories;

use App\User;

class UsersReponsitory extends AbstracRiponsitory{

    public function getModel(){

        return User::class;
    }
    public function getByIdUser($id){
        return $this->model->where('id',$id)->first();
    }
    public function getUserbyId($id,$recever){
        return $this->model->where('id',$recever)->first();
    }
}

