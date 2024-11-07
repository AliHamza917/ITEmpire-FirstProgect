<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateProfileImgController extends Controller
{
    //
    function UpdateProfileImg( Request $request,$id){

        $user = User::find($id);

        if ($user) {
            // Validate the profile image file
            $request->validate([
                'profile-img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);


            $imgdata = $request->file('profile-img');
            $name = $user->email . '.' . $imgdata->extension();

            $imgdata->storeAs('public/profile-image', $name);

            // Update the User profile image
            $user->profile_img = $name;
            $user->save();

            return response()->json(['success' => true]);
//            return redirect(route('homePage'))->with('info', 'Profile image uploaded successfully.');
        }

        return response()->json(['success' => false]);
//        return redirect(route('homePage'))->with('error', 'Unable to update profile image.');
    }


}
