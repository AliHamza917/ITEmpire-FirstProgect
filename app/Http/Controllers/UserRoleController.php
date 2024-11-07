<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //

    function MakeManager($id){

        $user = User::find($id);

        if (!$user == ''){
            $current_role = $user->user_role;

            if ($current_role == 'M'){
                $user->user_role = 'user';
                $user->save();
//
            }else{
                $user->user_role = 'M';
                $user->save();
//
            }
        }
        return redirect('user-table');

    }

}
