<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

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
}
