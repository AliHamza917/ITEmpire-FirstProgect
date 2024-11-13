<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserTableController extends Controller
{

    //
    public function UserTableData(Request $request){
        if ($request->ajax()) {

            // Fetch user data with specific fields
            if (Auth::user()->user_role ==='admin'){
                $data = User::select(['id', 'fullname', 'email', 'status', 'profile_img', 'created_by','user_role'])
                            ->where('user_role', '!=', 'admin')
                            ->get();

            }else{
                $data = User::select(['id', 'fullname', 'email', 'status', 'profile_img', 'created_by','user_role'])
                            ->where('created_by', '=', Auth::id())
                            ->get();
            }



                return DataTables::of($data)
                    ->addIndexColumn()  // Adds an auto-incrementing index to your table

                    ->addColumn('action', function($row) {  // Adds action buttons like Edit
                        if ($row->status == 1) {
                            $actionBtn = '<button data-id="' . $row->id . '" class="update-status btn btn-warning btn-sm">Deactivate User</button>';
                        } else {
                            $actionBtn = '<button data-id="' . $row->id . '" class="update-status btn btn-success btn-sm">Activate User</button>';
                        }
                        return $actionBtn;
                    })
                    ->make(true);  // Return data in JSON format



        }

        return view('UsersTable');  // Return the main view for non-AJAX requests

//

//        $managers = [];
//        // Retrieve all users if admin, otherwise only the users created by the authenticated manager
//        if (Auth::user()->user_role === 'admin') {
//            $users = User::query(); // Start with a base query for further filtering if needed
//            $managers = User::where('user_role' , 'M')->get();
//        } else {
//            $managerId = Auth::id();
//            $users = User::where('created_by', $managerId);
//        }
//
//        // Apply manager filter if provided (and if user is admin)
//        if ($request->filled('manager_id') && Auth::user()->user_role === 'admin') {
//            $users = $users->where('created_by', $request->manager_id); // Apply filter to existing query
//        }
//
//        $users = $users->get(); // Execute the query to retrieve the results
//
//        // Return partial view for Ajax requests
//        if ($request->ajax()) {
//            return view('users.partials.userTable', compact('users'))->render();
//        }
//
//        // Render main UsersTable view for non-Ajax requests
//        return view('UsersTable', compact('users' , 'managers'));

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

        if ($user) {  // Make sure the user exists
            // Toggle the status between 0 and 1
            $user->status = ($user->status == 1) ? 0 : 1;
            $user->save();  // Save the updated status
        }

        return response()->json(['success' => true]); // Return JSON response

//        return redirect()->route('UserTable');  // Redirect back to the user table page
//

    }
}
