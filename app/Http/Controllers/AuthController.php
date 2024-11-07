<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    function AuthSignUp(Request $request){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'pswd' => 'required|min:4',
        ]);

        $imgdata = $request->file('profile-img');

        $name = $request['email'].".". $imgdata->extension();
        $imgdata->storeAs('public/profile-image', $name);


        $user = new User();
        $user->fullname = $request['fullname'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['pswd']);
        $user->profile_img = $name;
        $user->save();


        return redirect(('/'));
    }

    function AuthSignIn(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:4',
        ]);
        $useremail =  $request->email;



        $check = User::select('status')->where('email', $useremail)->first();
//
       if ($check){
           $check=$check->status;

           if ($check == 1) {

               if (Auth::attempt($request->only('email', 'password'))) {

                   $user = Auth::user();

                   $role = $user->user_role;
                   $u_id = $user->id;
                   session(['role' => $role, 'u_id'=>$u_id]);

                   return redirect('homePage')->with('info', 'Login Successful');

               }else{

                   return redirect('/')->withErrors('Login Unsuccessfully');

               }

           }else{

               return redirect('/')->withErrors('warning','User Deactivated by Admin');

           }
       }else{
           return redirect('/')->withErrors('warning','With for the Admin Approvel');
       }
    }



    public function logout()
    {

        Auth::logout();
        session()->flush();
        return redirect('/');
    }

}
