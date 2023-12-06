<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Auth::user()->store->category;
        return view('pages.storeadmin.category', compact('categories'));
    }
    
    public function createCategory() {
        return view('pages.storeadmin.category-create');
    }

    public function storeCategory(Request $request) {
        $store = Auth::user()->store;
        $category_id = "CAT" . "-" . $store->store_id . "-" . Auth::user()->store->category->count() + 1;
        $category = new Category;
        $category->category_id = $category_id;
        $category->category_name = $request->name;
        $store->category()->save($category);
        return redirect()->route('store.category');
    }

    public function editCategory($id) {
        $category = Category::find($id);
        return view('pages.storeadmin.category-edit', compact('category'));
    }

    public function updateCategory($id, Request $request) {
        $category = Category::find($id);
        $category->category_name = $request->name;
        $category->save();
        return redirect()->route('store.category');
    }
}
