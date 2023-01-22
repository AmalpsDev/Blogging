<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Response;


class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.categories');
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3|max:255',
        ]);

        $slug = Str::slug($request->category_name);
        
        $category = Category::create([
            'name' => $request->category_name,
            'slug' => $slug,
        ]);

        return "Success";

    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return Datatables::of($categories)

        ->editColumn('created_at', function ($category) {
                return $category->created_at ? with (new Carbon($category->created_at))->format('d-M-Y'): '';
        })
        ->editColumn('updated_at', function ($category) {
                return $category->created_at ? with (new Carbon($category->updated_at))->format('d-M-Y'): '';
        })
        ->make(true);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        if($category){
            return $category;
        }else{
            return Response::json(['error' => 'Not Found'],404);
        }
    }

    public function updateCategory(Request $request)
    {
       
        $request->validate([
            'edit_category' =>'required|min:3|max:255',
        ],
        [
            'edit_category.required' => 'The Category name field is required.',
            'edit_category.min' => 'The Category name should be atleat 3 characters.',
            'edit_category.max' => 'The Category name may no be greater than 255 characters.'
        ]);

        $category = Category::find($request->category_id);
        $category->name = $request->edit_category;
        $category->slug = Str::slug($request->edit_category);
        $category->save();
        return "Success";
       
    }

     public function deleteCategory($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
        }else{
            return Response::json(['error' => 'Not Found',404]);
        }
    }
}
