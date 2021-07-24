<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\models\User;

class AuthController extends Controller
{
    //
    function authen(Request $request) {
        // Check 
        $request->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:12'
        ]);
        
        $user = User::where("username","=",$request->username)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){

                $request->session()->put('loggedUser',$user->id);
                $request->session()->put('ssFullname',$user->firstname.' '.$user->lastname);
                $request->session()->put('loggedUserInfo', [
                    'userid' => $user->id, 
                    'firstname' => $user->firstname, 
                    'lastname' => $user->lastname, 
                    'email' => $user->email,
                    'usertype' => $user->usertype
                ]);
                return redirect(route('dashboard'));
            }else{
                return back()->with('fail','Invalid Password!');
            }
        }else{
            return back()->with('fail','No Account found for this Username!');
        }
        
    }

    function logout() {
        if(session()->has('loggedUser')){
            session()->pull('loggedUser');
        }
        return redirect(route('login'));
    }

}
