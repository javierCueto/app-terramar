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
       
        if(Auth::user()->role_id==1){
            $documents= document::all();
        }else{
            $documents= document::where('user_id',$user_id)->get();
        }

        
        return view('system.index')->with(compact('documents'));
    }
}
