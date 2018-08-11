<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\document;
use Mail;
Use Session;
use Redirect;
use File;

class DocumentController extends Controller
{
    public function index(){
    	 return view('system.documents.load');
    }



    public $user_mail;
    public function store(Request $request){
    	
    	
    	$now = new \DateTime();
 		$date_Actual =$now->format('Y-m-d');
    	$user_id=Auth::user()->id;
    	$this->user_mail=Auth::user()->email;

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
	           $fileName='images/documents/'.$fileName;
	         try {
                Mail::send('system.documents.send',['filename' => $fileName, 'name'=> $name],function($msj){
                    $msj->subject('Se cargo un nuevo archivo');
                    $msj->to($this->user_mail);
                    $msj->cc('javeliecm@gmail.com');
                });
                 
             } catch (Exception $e) {
                 return response()->json(['success'=>'Datos Cargados Correctamente, pero el correo no se envio']);
             }
	           
	      }

          return response()->json(['success'=>'Datos Cargados Correctamente']);

	   // return redirect('system');
    }




     public function destroy($id){
        $notification="No fue posible eliminar el  documento, no existe o esta siendo utilizado :(";
        $documentf=document::find($id);
   
        $fullPath=public_path() . '/images/documents/'.$documentf->document;
        $deleted=File::delete($fullPath); 
        

        if($deleted){
               $documentf->delete();
                $notification="Documento eliminado :)";
          }
         return back()->with(compact("notification"));
     }


}
