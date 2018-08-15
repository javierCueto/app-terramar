<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\document;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $role=Auth::user()->role_id;
       
        if($role==1){
            $documents= document::paginate(10);
        }else{
            $documents= document::where('user_id',$user_id)->paginate(10);
        }

        
        return view('system.index')->with(compact('documents','role'));
    }
}
