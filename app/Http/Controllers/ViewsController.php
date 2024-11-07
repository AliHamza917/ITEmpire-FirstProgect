<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    //
    function signUpView(){
        return view('SignUp');
    }


    function UpdateProfileView(){
        return view('EditProfile');
    }

    function createProductView(){
        $categories =Category::all();

        return view('products.CreateProduct' , ['categories' =>$categories]);
    }

    function createProductByManager(){
        $logedUser = Auth::id();

        $users = User::where('created_by' , $logedUser)->get();
//        dd($users->toSql());
        $categories =Category::all();

        return view('users.ManagerAddProduct' , ['categories' =>$categories, 'users'=> $users]);
    }

    function createProductByAdminView(){
            $users = User::all();
            $categories =Category::all();

            return view('admin.createProductByAdmin' , ['categories' =>$categories, 'users'=> $users]);
        }

    function createNewUserByAdminView(){
                $users = User::all();


                return view('admin.createNewUserByAdmin' , ['users'=> $users]);
    }

    function ProductCategoryView(){
        return view('categories.ProductCategory');
    }

    function createNewUser(){
        return view('users.CreateUser');
    }

    function createNewManagerView(){
        return view('manager.createManager');
    }





}
