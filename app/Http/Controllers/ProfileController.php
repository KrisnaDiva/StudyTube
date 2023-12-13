<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $user=auth()->user();
        return view('profile.index',[
            'user'=>$user
        ]);
    }
    public function edit(User $user){
        return view('profile.edit',[
            'user'=>$user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules=[
            'name'=>'required|max:255',
            'image'=>'image|file|max:1024',
        ];
        if($request->email!=$user->email){
            $rules['email']='required|email:dns|unique:users';
        }
        $validatedData=$request->validate($rules);
        if($request->file('image')){
            if($user->image){
                 Storage::delete($user->image);
            }
            $validatedData['image']=$request->file('image')->store('user-images');
        }
        
        $user->update($validatedData);
        return redirect()->route('profile.index')->with('success','Profile Has Been Updated!');
    }
}
