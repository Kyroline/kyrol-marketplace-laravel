<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Http\Controllers\RajaongkirController;
use App\Models\Product;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function shoppingcart () {
        $user_id = Auth::user()->id;
        $carts = Auth::user()->cart;
        return view('pages.cart', compact(['user_id', 'carts']));
    }

    public function deleteCartItem ($cart_id, $variant_id) {
        $cart = CartItem::where([['cart_id', $cart_id], ['variant_id', $variant_id]])->first();
        if ($cart->cart->cart_item->count() == 1) {
            $cart->cart->delete();
        } else {
            CartItem::where([['cart_id', $cart_id], ['variant_id', $variant_id]])->delete();
        }
        return redirect()->route('user.shoppingcart');
    }

    public function updateCartPrice (Request $request) {
        $cart = Cart::find($request->cart_id);
        $cart_items = $cart->cart_item;
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item->qty * $item->product_variant->price;
        }
        return view('partials.cart-price', compact('cart_items', 'total'));
    }

    public function updateCartPrice2 ($cart_id) {
        $cart = Cart::find($cart_id);
        $cart_items = $cart->cart_item;
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item->qty * $item->product_variant->price;
        }
        return view('partials.cart-price', compact('cart_items', 'total'));
    }

    public function checkout(Request $request) {
        $cart = Cart::find($request->cart_id);
        $address = User::find(Auth::user()->id)->user_address;
        $items = $cart->cart_item;
        return view('pages.user.checkout', compact('cart', 'items', 'address'));
    }

    public function checkoutUpdateAddress(Request $request) {
        $address = UserAddress::find($request->address_id);
        return view('partials.user-address', compact('address'));
    }

    public function profile () {
        return view('pages.user.profile');
    }

    public function address () {
        $addresses = Auth::user()->user_address;
        // $addresses = UserAddress::where('user_id', Auth::user()->user_id);
        return view('pages.user.address', compact('addresses'));
    }

    public function createAddress () {
        return view('pages.user.address-create');
    }

    public function storeAddress (Request $req) {
        $address = new UserAddress;
        $address->label = $req->label;
        $address->receiver = $req->receiver;
        $address->phone = $req->phone;
        $address->address = $req->address;
        $address->province = app('App\Http\Controllers\RajaongkirController')->getProvinceName($req->province);;
        $address->province_code = $req->province;
        $address->city = app('App\Http\Controllers\RajaongkirController')->getCityName($req->city);
        $address->city_code = $req->city;

        User::find(Auth::user()->id)->user_address()->save($address);
        // $addresses = UserAddress::where('user_id', Auth::user()->user_id);
        return redirect()->route('user.address');
    }

    public function storeTransaction (Request $request) {
        $address = UserAddress::find($request->address);
        $cart = Cart::find($request->cart_id);
        $courier = $request->courier;
        $service = explode('-', $request->service)[0];
        $fee = explode('-', $request->service)[1];
        $invoice_id = "INV-" . Auth::user()->id . "-" . Invoice::where('user_id', Auth::user()->id)->count() + 1;

        $invoice = new Invoice;
        $invoice->store_id = $cart->store->store_id;
        $invoice->user_id = Auth::user()->id;
        $invoice->invoice_id = $invoice_id;
        $invoice->name = $address->receiver;
        $invoice->address = $address->address;
        $invoice->province = $address->province;
        $invoice->city = $address->city;
        $invoice->courier = $courier;
        $invoice->service = $service;
        $invoice->fee = $fee;
        $invoice->status = 0;

        $invoice->save();

        $invoice = Invoice::find($invoice_id);
        foreach ($cart->cart_item as $item) {
            $invoice_item = new InvoiceItem;
            $invoice_item->invoice_id = $invoice_id;
            $invoice_item->product_id = $item->product_variant->product->product_id;
            $invoice_item->variant_id = $item->product_variant->variant_id;
            $invoice_item->invoice_item_id = $invoice_id . "-" . InvoiceItem::where('invoice_id', $invoice_id)->count() + 1;
            $invoice_item->qty = $item->qty;
            $invoice_item->price = $item->product_variant->price * $invoice_item->qty;
            $invoice_item->timestamps = false;
            $invoice_item->save();
        }

        $cart->delete();
        return redirect()->route('user.shoppingcart');  
    }

    public function landing() {
        $products = Product::all();
        return view('pages.index', compact('products'));
    }
}
