<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id){
        
        $category = Category::find($id);


        return  view('admin.categories.show', compact('category'));
    }
}
