<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    function createCategory(Request $request){

        $request->validate([
           'p_category'=> 'required'
        ]);

        Category::create([

            'category_name' =>$request->p_category,
            'manager_id' => Auth::id()
        ]);

//        return redirect('category-table');

        return response()->json(['success' => true]);


    }

    function categoryTableData(){
        $category = Category::all();

        return view('categories.CategoryTable' , ['category' => $category]);
    }

   function delCategory($id){
        $category = Category::find($id);
        if (!$category==''){
            dd('dell success Fully');
            $category->delete();
        }

        return redirect('category-table');
    }

   function getCategory($id){
        $category = Category::find($id);
        if($category){
            return view('categories.EditCategory',['category' =>$category]);
        }else{
            return redirect()->back()->withErrors('Category not found');
        }
   }

   function UpdateCategory(Request $request , $id){

       {
           // Validate the input
           $request->validate([
               'p_category' => 'required|string|max:255',
           ]);

           // Find the category by ID
           $category = Category::find($id);

           if (!$category) {
               return redirect()->back()->withErrors('Category not found');
           }


           $category->category_name = $request->p_category;
           $category->save();


           return response()->json(['success' => true]);

//           return redirect('category-table')->with('success', 'Category updated successfully');
       }
   }


}
