<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadFileController extends Controller {
   public function index() {
      return view('uploadfile');
   }
   public function showUploadFile(){
       //print_r($request);exit;
        //$image = time().'.'.$request->audio->getClientOriginalExtension();
        //$request->image->move(public_path('uploads'), $image);
        //$url='images/'.$image;
        //return response()->json(['url'=>$url]);
      //$file = $request->file('audio');
       print_r($_POST);echo"<br><br><br>3";
      print_r($_FILES);echo"<br><br><br>1";
      print_r($_REQUEST);echo"<br>2";
     
      exit;
      
     
   
   }
}