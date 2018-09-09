<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\document;
use App\companie;
use Mail;
Use Session;
use Redirect;
use File;
use ZipArchive;


class DocumentController extends Controller
{
    public function index($companieName){
    	 return view('companie.documents.load');
    }



    public $user_mail;
    public $empresa_mail;
    public function store(Request $request){
    	

    	$now = new \DateTime();
      $date_Actual =$now->format('Y-m-d');
 		  $monthYear =$now->format('Y-m');
      $user_id=Auth::user()->id;
      $namecompanie=Auth::user()->companie->name_short;
      $idcompanie=Auth::user()->companie_id;
    	$this->empresa_mail=Auth::user()->companie->email;
    	$this->user_mail=Auth::user()->email;


    	$file=$request ->file('document');

      //name now is uuid
      $exten=strtolower($file->getClientOriginalExtension());
    	$uuid=$request ->input('uuid');
     	$path=public_path() . '/files/'.$namecompanie.'/'.$monthYear;
     	$fileName=$file->getClientOriginalName();
     	$moved=$file->move($path,$uuid.'.'.$exten);

	      if($moved){
	           $fileFac=new document();
             $fileFac->name=$fileName;
             $fileFac->uuid=$uuid;
	           $fileFac->date=$date_Actual;
	           $fileFac->document=$uuid.'.'.$exten;
	           //$productImage->featured=;
             $fileFac->user_id=$user_id;
	           $fileFac->companie_id=$idcompanie;
             $fileFac->url='files/'.$namecompanie.'/'.$monthYear.'/';
             $fileName='files/'.$namecompanie.'/'.$monthYear.'/'.$uuid.'.'.$exten;
	           $fileFac->save();

                Mail::send('system.documents.send',['filename' => $fileName, 'name'=> $uuid],function($msj){
                    $msj->subject('Se cargo un nuevo archivo');
                    $msj->to($this->user_mail);
                    $msj->cc($this->empresa_mail);
                });
                 
          return response()->json(['success'=>'Datos Cargados Correctamente, desea cargar mas?']);
	           
	      }

          return response()->json(['success'=>'Lo sentimos el archivo no se puedo subir :(']);

	   // return redirect('system');
    }




     public function destroy($id){
        $notification="No fue posible eliminar el  documento, no existe o esta siendo utilizado :(";
        $documentf=document::find($id);
   
        $fullPath=public_path() .'/'.$documentf->url.$documentf->document;
        $deleted=File::delete($fullPath); 
        

        if($deleted){
               $documentf->delete();
                $notification="Documento eliminado :)";
          }
         return back()->with(compact("notification"));
     }


     public function zip(Request $request){

       $initial=\Carbon\Carbon::parse($request->fechainicial)->format('Y-m-d');
        $finald=\Carbon\Carbon::parse($request->fechafinal)->format('Y-m-d');

        if($request->has('download')) {
            $user_id=Auth::user()->id;
       
            
            $documents= document::where('date',">=",$initial)  
                                ->where('date',"<=",$finald)  
                                ->where('companie_id',$request->idem)  
                                ->get();
            

            // Define Dir Folder
            $public_dir=public_path();
            // Zip File Name
            $zipFileName = 'All.zip';
            $fullPath=public_path() . '/downloads/facturas/'.$zipFileName ;
            $deleted=File::delete($fullPath); 

            // Create ZipArchive Obj
            $zip = new ZipArchive;

            if ($zip->open($public_dir . '/downloads/facturas/' . $zipFileName, ZipArchive::CREATE) === TRUE) {    
                // Add Multiple file   

                $cont=0;
                foreach($documents as $document) {
                    $zip->addFile($public_dir .'/'.$document->url.$document->document, $document->document);
                    $cont++;
                }        

                $zip->close();

            }

            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/downloads/facturas/'.$zipFileName;
            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers);
            }
        }
        return back();
     }




     public function zip_filter(Request $request){
      
         $datos=$request->input('search'); //Aqui obtienes el valor del input ajax


        
            

            // Define Dir Folder
            $public_dir=public_path();
            // Zip File Name
            $zipFileName = 'All.zip';
            $fullPath=public_path() . '/downloads/facturas/'.$zipFileName ;
            $deleted=File::delete($fullPath); 

            // Create ZipArchive Obj
            $zip = new ZipArchive;

            if ($zip->open($public_dir . '/downloads/facturas/' . $zipFileName, ZipArchive::CREATE) === TRUE) {    
                // Add Multiple file   

                $cont=0;
                foreach($datos as $dato) {

                      $document=document::find($dato);

                    $zip->addFile($public_dir .'/'.$document->url.$document->document, $document->document);
                    $cont++;
                }        

                $zip->close();

            }

            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/downloads/facturas/'.$zipFileName;
            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers);
            }
  
     
     }




    public function show($companieName){

      $companie=companie::where("name_short",$companieName)->first();
      
      $user_id=Auth::user()->id;
      $role=Auth::user()->role_id;


      if(is_null($companie) || empty($companie)){
          abort(404);
        }

    

      // if($role<3){
            $documents= document::where("companie_id",$companie->id)->get();
        //}else{
          //  $documents= document::where('user_id',$user_id)->paginate(10);
        //}

        if($role>2){
           return view('companie.documents.index')->with(compact('documents','role','companie'));
        }

        return view('system.companies.documents')->with(compact('documents','role','companie'));
    }


    public function sendemail(){

      $user_namecompanie=Auth::user()->comapanie->name_short;


       Mail::send('system.documents.send',['filename' => "prueba", 'name'=> "prueba"],function($msj){
                    $msj->subject('Se cargo un nuevo archivo');
                    $msj->cc('javeliecm@gmail.com');
                });
       return back();
    }

}
