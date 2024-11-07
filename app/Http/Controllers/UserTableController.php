<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTableController extends Controller
{

    //
    public function UserTableData(Request $request){


        $managers = [];
        // Retrieve all users if admin, otherwise only the users created by the authenticated manager
        if (Auth::user()->user_role === 'admin') {
            $users = User::query(); // Start with a base query for further filtering if needed
            $managers = User::where('user_role' , 'M')->get();
        } else {
            $managerId = Auth::id();
            $users = User::where('created_by', $managerId);
        }

        // Apply manager filter if provided (and if user is admin)
        if ($request->filled('manager_id') && Auth::user()->user_role === 'admin') {
            $users = $users->where('created_by', $request->manager_id); // Apply filter to existing query
        }

        $users = $users->get(); // Execute the query to retrieve the results

        // Return partial view for Ajax requests
        if ($request->ajax()) {
            return view('users.partials.userTable', compact('users'))->render();
        }

        // Render main UsersTable view for non-Ajax requests
        return view('UsersTable', compact('users' , 'managers'));

//        Old
//        if(Auth::user()->user_role === 'admin'){
//            $users = User::all();
//        }else{
//            $managerId = Auth::id();
//            $users =User::where('created_by' , $managerId)->get();
//
//        }
//
//        if (!empty($request->manager_id) && Auth::user()->user_role === 'admin') {
//            $users = User::where('created_by' , $request->manager_id );
//            return response()->json(['success' => true]);
//        }
//
//        if ($request->ajax()) {
//            return view('users.partials.userTable', compact('users'))->render();
//        }
//
//
//        return view('UsersTable', ['users' => $users]);
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
