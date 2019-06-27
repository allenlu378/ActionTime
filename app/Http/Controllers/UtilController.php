<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UtilController extends Controller
{
    //image upload
    public function upload(){

        $file = Input::file('fileupload');
        if($file -> isValid()){
            $extension = $file -> getClientOriginalExtension(); //file extension
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file -> move(base_path().'/public/upload',$newName);
            $filepath = 'public/upload'.$newName;
            return $newName;
        }
    }
}
