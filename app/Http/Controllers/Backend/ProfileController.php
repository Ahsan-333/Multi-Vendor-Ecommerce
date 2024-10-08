<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use File;


class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'email' => ['required','email', 'unique:users,email,' . Auth::user()->id],
            'image' => 'image|max:2048'
        ]);

        $user = Auth::user();

        if($request->hasFile('img')){
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }
            $img = $request->img;
            $imageName = rand().'_'.$img->getClientOriginalName();
            $img->move(public_path('uploads'), $imageName);
            $path = '/uploads/'.$imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        // toastr()->success('Your Profile has been updated successfully.');
        
        flash()->success('Profile updated successfully.');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8'
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        flash()->success('Password updated successfully.');

        return redirect()->back();
    }
}
