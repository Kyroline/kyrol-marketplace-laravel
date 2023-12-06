<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Storage;

class StoreController extends Controller
{
    public function createStore() {
        $user = Auth::user();
        if (Auth::user()->store == null) {
            return view('pages.user.open-store');
        }
        return redirect()->route('store');
    }

    public function storeStore(Request $request) {
        $user = User::find(Auth::user()->id);
        $store_id = "ST" . $user->id;
        $store = new Store;
        $store->store_id = $store_id;
        $store->store_name = $request->name;
        $store->store_domain = $request->domain;
        $store->address = $request->address;
        $store->province = app('App\Http\Controllers\RajaongkirController')->getProvinceName($request->province);;
        $store->province_code = $request->province;
        $store->city = app('App\Http\Controllers\RajaongkirController')->getCityName($request->city);
        $store->city_code = $request->city;

        $user->store()->save($store);
        return view('store');
    }

    public function index() {
        $store = Auth::user()->store;
        return view('pages.store-user', compact('store'));
    }

    public function store($store_domain) {
        $store = Store::where('store_domain', $store_domain)->first();
        return view('pages.store-user', compact('store'));
    }

    public function product() {
        $store = Auth::user()->store;   
        return view('pages.storeadmin.product', compact('store'));
    }

    public function createProduct() {
        $store = Auth::user()->store;
        $categories = $store->category;
        return view('pages.storeadmin.product-create', compact('store', 'categories'));
    }

    public function storeProduct(Request $request) {
        $store = Auth::user()->store;

        $product_image = $request->image;
        $filename = time() . "." . $product_image->getClientOriginalExtension();
        $product_image->move('images/', $filename);
        $product_id = $store->store_id . '-' . Product::where('store_id', $store->store_id)->count() + 1;
        $product = new Product;
        $product->product_id = $product_id;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->image = $filename;
        $store->product()->save($product);
        $var_count = 0;
        $product = Product::find($product_id);
        foreach($request->name as $name) {
            $variant = new ProductVariant;
            $variant->variant_id = $request->sku[$var_count];
            $variant->variant_name = $name;
            $variant->price = $request->price[$var_count];
            $variant->stock = $request->stock[$var_count];
            $variant->weight = $request->weight[$var_count];
            $product->product_variant()->save($variant);
            $var_count++;
        }

        if ($request->has('category')) {
            foreach($request->category as $category_id) {
                ProductCategory::create([
                    'product_id' => $product_id,
                    'category_id' => $category_id
                ]);
            }
        }
        return redirect()->route('store.products');
    }

    public function editProduct($id) {
        $store = Auth::user()->store;
        $product = Product::find($store->store_id . "-" . $id);
        $categories = $store->category;
        $selectedCat = $product->product_category->pluck('category_id')->toArray();
        return view('pages.storeadmin.product-edit', compact(['store', 'product', 'categories', 'selectedCat']));
    }

    public function updateProduct($id, Request $request) {
        $store = Auth::user()->store;
        $product_id = $store->store_id . "-" . $id;
        $product = Product::find($product_id);

        if ($request->has('image')) {
            $product_image = $request->image;
            $filename = time() . "." . $product_image->getClientOriginalExtension();
            $product_image->move('images/', $filename);
            $product->image = $filename;
        }
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $store->product()->save($product);

        $var_count = 0;
        //old variants
        if ($request->has('oldname')) {
            foreach($request->oldname as $name) {
                $variant = ProductVariant::find($request->oldsku[$var_count]);
                $variant->variant_name = $request->oldname[$var_count];
                $variant->price = $request->oldprice[$var_count];
                $variant->stock = $request->oldstock[$var_count];
                $variant->weight = $request->oldweight[$var_count];
                $product->product_variant()->save($variant);
                $var_count++;
            }
        }

        $var_count = 0;
        //new variants
        if ($request->has('name')) {
            foreach($request->name as $name) {
                $variant = new ProductVariant;
                $variant->variant_id = $request->sku[$var_count];
                $variant->variant_name = $name;
                $variant->price = $request->price[$var_count];
                $variant->stock = $request->stock[$var_count];
                $variant->weight = $request->weight[$var_count];
                $product->product_variant()->save($variant);
                $var_count++;
            }
        }

        ProductCategory::where('product_id', $store->store_id . "-" . $id)->delete();
        if ($request->has('category')) {
            foreach($request->category as $category_id) {
                // ProductCategory::where([['product_id', $store->store_id . "-" . $id], ['category_id', $category_id]])->delete();
                ProductCategory::create([
                    'product_id' => $store->store_id . "-" . $id,
                    'category_id' => $category_id
                ]);
            }
        }
        return redirect()->route('store.products');
    }
}
