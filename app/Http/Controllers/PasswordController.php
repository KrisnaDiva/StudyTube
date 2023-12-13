<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(User $user){
        return view('password.edit',[
            'user'=>$user
        ]);
 
   }public function update(Request $request, User $user)
   {
       $validatedData=$request->validate([
        'password'=>'required|min:5|max:255',
       ]);
       $validatedData['password']=bcrypt($validatedData['password']);
       if (Hash::check($request->old, $user->password)) {
        $user->update($validatedData);
        return redirect()->route('password.edit', $user->id)->with('success', 'Password Has Been Updated!');
    } else {
        return redirect()->route('password.edit', $user->id)->with('error', "The old password doesn't match");
    }
      
       
       
       
   }
}
