<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\role;
use App\companie;
use App\User;

class UserController extends Controller
{	

    public function index(){

    	$roles=role::select('id','name')->where('id', '>',1)->get();
    	$companies=companie::select('id','name')->where('status',true)->get();


    	return view('system/user/index')->with(compact('roles','companies'));
    }



    public function store(Request $request){

    	User::create([
        	'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->rol,
            'companie_id'=>$request->companie,
        ]);


    	return redirect('/system/user');
    }
}
