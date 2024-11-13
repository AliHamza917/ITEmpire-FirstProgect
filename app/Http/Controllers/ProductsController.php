<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\select;

class ProductsController extends Controller
{
    //
    function CreateProduct(Request $request){

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
        $product->user_id = Auth::id();
        $product->product_img = $name;
//        $product->u_id = $userId;
        $product->status = '1';



        $product->save();

        return response()->json(['success' => true]);

    }
//
    function ProductsTable(Request $request){
//        dd($request->all());
        $categories = Category::all();
        $Allusers = collect();  // Ensure this variable is always defined






        $productsQuery = Product::with(['category', 'user']);
//        Practice


        // Check user role and apply appropriate conditions
        if (Auth::user()->user_role !== 'admin') {
            $userId = Auth::id();

//            dd($userId);
            if (Auth::user()->user_role === 'M') {
                // For manager role, allow products created by the user under the manager
                $productsQuery->where('m_id', $userId);
//                $productsQuery->where(function ($query) use ($userId) {
//                    $query->where('user_id', $userId)
//                        ->orWhere('m_id', $userId);
//                });
            } else {
                // For non-admins who are not managers, show only their own products
                $productsQuery->where('user_id', $userId);
            }
        }



       // Apply category filter if selected
        if (!empty($request->category_id)) {
            $productsQuery->where('category_id', $request->category_id);

        }
        if (!empty($request->u_id)) {
            $productsQuery->where('user_id', $request->u_id);

        }

        // Apply manager filter if selected and user is admin
        if (!empty($request->manager_id) && Auth::user()->user_role === 'admin') {
            $productsQuery->where('m_id', $request->manager_id);

        }

        // Get the products based on the above conditions
        $products = $productsQuery->get();
        if ($request->ajax()) {

            return view('products.partials.productsTable', compact('products'))->render();
        }

        // Fetch users list only for admin or manager roles
        $users = [];
        $managers = [];
        if (Auth::user()->user_role === 'admin' || Auth::user()->user_role === 'M') {
            $usersQuery = User::query();

            // Fetch only managers for the manager filter
            if (Auth::user()->user_role === 'admin') {
                $managers = $usersQuery->where('user_role', 'M')->get();
            } else {
                $managers = [];
            }

            // Managers see only users they manage
            if (Auth::user()->user_role === 'M') {
                $usersQuery->where('created_by', $userId);
            }
            $Allusers = collect();
            if (Auth::user()->user_role === 'admin'){
                if (!empty($request->manager_id)){
//                    dd($request->manager_id);
                    $Allusers = User::where('created_by' , $request->manager_id)->get();

                }else{
                    $Allusers =User::all();
                }

            }
            $users = $usersQuery->get();
        }

        return view('products.ProductsTable', [
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
            'managers' => $managers, // Pass managers to the view
            'Allusers' => $Allusers // Pass managers to the view
        ]);

    }

//Products Controller

    function delProducts($id){
        $product = Product::find($id);
        if (!$product==''){
            dd('dell success Fully');
            $product->delete();
        }

        return redirect('products-table');
    }

    function getProducts($id){
        $product = Product::find($id);
        if($product){
            return view('products.EditProduct',['product' =>$product]);
        }else{
            return redirect()->back()->withErrors('Product not found');
        }
    }

    function UpdateProducts(Request $request , $id){

        {
            // Validate the input
            $request->validate([
                'p_name' => 'required|unique:products,product_name,' . $id,
            ]);



            // Find the product by ID
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->withErrors('Product not found');
            }

            //Replace Current Image
            $imgdata = $request->file('product-img');

            if (!empty($imgdata)){


                $name = $request['p_name'].".". $imgdata->extension();
                $imgdata->storeAs('public/product-image', $name);
            }


            $product->product_name = $request->p_name;
            $product->product_price = $request->p_price;

            if (!empty($imgdata)){
                $product->product_img = $name;
            }

            $product->save();

            return response()->json(['success' => true]);
//            return redirect('products-table')->with('success', 'Product updated successfully');
        }
    }

}
