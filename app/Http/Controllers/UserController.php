<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\role;
use App\companie;
use App\User;

class UserController extends Controller
{	

    public function index(){

    	$roles=role::select('id','name')->where('id', '>',1)->get();
    	$companies=companie::select('id','name')->where('status',true)->get();

 
    	//dd(response()->json(['data'=>$users]));

    	return view('system/user/index')->with(compact('roles','companies'));
    	
    }


    public function getUsers(){
    	//$users=Auth::user()->select('id')->where('role_id','!=','1')->get();
    	//$companies=companie::select('id','name')->where('status',true)->get();

    	$users=DB::table('users')
    		->select('users.id as id','users.name as userName','users.email as userEmail','companies.name','roles.name as roleName')
    		->leftJoin("companies","users.companie_id",'=',"companies.id")
    		->leftJoin("roles","roles.id",'=',"users.role_id")
    		->where('role_id','!=','1')
    		->get();

    	//dd($us);
    	return response()->json(['data'=>$users]);
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
