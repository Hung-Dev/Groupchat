<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Reponsitories\UsersReponsitory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersReponsitory $UsersReponsitory)
    {
        $this->middleware('auth');
        $this->UsersRepo = $UsersReponsitory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
        $recever=Route::input('id');	
        $id=Auth::id();
        $user = $this->UsersRepo->getUserbyId($id, $recever);
        return view('home')->with(['user'=> $user]);
    }

    public function allmessage()
    { 
        return view('allmessage');
    }
    function jsonResponse(){
        $user = DB::table('chats')->get();
        return response()->json($user);
    }
}
