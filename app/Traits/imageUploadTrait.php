<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait imageUploadTrait{
    public function uploadImage(Request $request, $inputName, $path){
            $image = $request->$inputName;
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;
            $image->move(public_path($path), $imageName);
            return $path.'/'.$imageName;
        }

    }
