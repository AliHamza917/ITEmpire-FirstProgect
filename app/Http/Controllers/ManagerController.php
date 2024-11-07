<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    //
    function addNewUser(Request $request){
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
        $user->created_by = Auth::id();
        $user->save();


        return redirect(('user-table'));
    }
 function addNewUserByAdmin(Request $request){
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
        $user->created_by = $request['m_id'];
        $user->save();


        return redirect(('user-table'));
    }

    function createNewManager(Request $request){
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
        $user->user_role = 'M';
        $user->created_by = 'admin';

        $user->save();


        return redirect(('user-table'));
    }

    function addProductByManager(Request $request){

        $request->validate([
            'p_name' => 'required | unique:products,product_name,',
            'p_price' => 'required',

        ]);

        $imgdata = $request->file('product-img');

        $name = $request['p_name'].".". $imgdata->extension();
        $imgdata->storeAs('public/product-image', $name);


        $product = new Product();
        $product->product_name = $request->p_name;
        $product->product_price = $request['p_price'];
        $product->category_id = $request['category_id'];
        $product->user_id = $request['user_id'];
        $product->product_img = $name;
        $product->m_id = $request['user_id'];
//        $product->u_id = $userId;
        $product->status = '1';



        $product->save();

        return redirect('products-table');
    }

     function addProductByAdmin(Request $request){

            $request->validate([
                'p_name' => 'required | unique:products,product_name,',
                'p_price' => 'required',

            ]);

            $imgdata = $request->file('product-img');

            $name = $request['p_name'].".". $imgdata->extension();
            $imgdata->storeAs('public/product-image', $name);


            $product = new Product();
            $product->product_name = $request->p_name;
            $product->product_price = $request['p_price'];
            $product->category_id = $request['category_id'];
            $product->user_id = $request['user_id'];
            $product->product_img = $name;
            $product->m_id = $request['m_id'];
    //        $product->u_id = $userId;
            $product->status = '1';



            $product->save();

            return redirect('products-table');
        }





}
