<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

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
}