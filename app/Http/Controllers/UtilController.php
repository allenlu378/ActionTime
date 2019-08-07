<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UtilController extends Controller
{
    //image upload
    public function upload($type){

        $input = Input::all();
        if(array_key_exists('img', $input)){
            $file = $input['img'];
        }
        else if(array_key_exists('img_edit', $input)){
            $file = $input['img_edit'];
        }
        else if($type == 'task'){
            return 'task.png';
        }
        else if($type == 'reward'){
            return 'reward_img.png';
        }
        else if($type == 'user'){
            return 'user.png';
        }


        if($file -> isValid()){
            $extension = $file -> getClientOriginalExtension(); //file extension
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file -> move(base_path().'/public/upload',$newName);
            $filepath = 'public/upload'.$newName;
            return $newName;

        }
    }
}
