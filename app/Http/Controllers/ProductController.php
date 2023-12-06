<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Store;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($store_id, $product_id) {
        $product = Product::where('product_id', $product_id)->first();
        $store = Store::where('store_domain', $store_id)->first();

        $review = Review::where('product_id', $product_id);
        $review1 = Review::where([['product_id', $product_id], ['score', 1]])->count();
        $review2 = Review::where([['product_id', $product_id], ['score', 2]])->count();
        $review3 = Review::where([['product_id', $product_id], ['score', 3]])->count();
        $review4 = Review::where([['product_id', $product_id], ['score', 4]])->count();
        $review5 = Review::where([['product_id', $product_id], ['score', 5]])->count();
        return view('pages.product', compact('product', 'store', 'review', 'review1', 'review2', 'review3', 'review4', 'review5'));
    }

    public function addToCart(Request $request, $store_domain, $product_id) {
        $store = Store::where('store_domain', $store_domain)->first();
        if (!(Cart::where([['store_id', $store->store_id], ['user_id', Auth::user()->id]])->count() > 0)) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->store_id = $store->store_id;
            $cart->cart_id = "CART-" . Auth::user()->id . "-" . $store->store_id;
            $cart->timestamps = false;
            $cart->save();
        }
        $cart = Cart::where([['store_id', $store->store_id], ['user_id', Auth::user()->id]])->first();
        $cart_item = new CartItem;
        $cart_item->cart_id = $cart->cart_id;
        $cart_item->variant_id = $request->variant_id;
        $cart_item->qty = $request->qty;
        $cart_item->timestamps = false;
        $cart->cart_item()->save($cart_item);
        return redirect()->route('user.shoppingcart');
    }
}
