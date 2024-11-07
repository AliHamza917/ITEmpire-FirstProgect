<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTableController extends Controller
{

    //
    public function UserTableData(){
        if(Auth::user()->user_role === 'admin'){
            $users = User::all();
        }else{
            $managerId = Auth::id();
            $users =User::where('created_by' , $managerId)->get();

        }


        return view('UsersTable', ['users' => $users]);
    }

    public function UpdateStatus($id){
        $user = User::find($id);
        if (!$user == ''){
            $current_status = $user->status;

            if ($current_status == 1){
                $user->status = 0;
                $user->save();
//
            }else{
                $user->status = 1;
                $user->save();
//
            }
        }
        return redirect('user-table');

    }
}
