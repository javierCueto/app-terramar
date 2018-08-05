<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\document;

use File;

class DocumentController extends Controller
{
    public function index(){
    	 return view('system.documents.load');
    }




    public function store(Request $request){
    	
    	$now = new \DateTime();
 		$date_Actual =$now->format('Y-m-d');
    	$user_id=Auth::user()->id;

    	$file=$request ->file('document');
    	$name=$request ->input('name');
     	$path=public_path() . '/images/documents';
     	$fileName=uniqid().$file->getClientOriginalName();
     	$moved=$file->move($path,$fileName);

	      if($moved){
	           $fileFac=new document();
	           $fileFac->name=$name;
	           $fileFac->date=$date_Actual;
	           $fileFac->document=$fileName;
	           //$productImage->featured=;
	           $fileFac->user_id=$user_id;
	           $fileFac->save();
	      }

	    return redirect('system');
    }

}
