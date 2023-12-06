<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Review;

class TransactionController extends Controller
{
    public function indexStore()
    {
        $store = Auth::user()->store;
        $invoices = $store->invoice;
        return view('pages.storeadmin.transaction', compact('invoices'));
    }

    public function editStore($id)
    {
        $invoice = Invoice::find($id);
        $store = $invoice->store;
        $buyer = $invoice->user;
        return view('pages.storeadmin.transaction-edit', compact('invoice', 'store', 'buyer'));
    }

    public function updateStore($id, Request $request)
    {
        $invoice = Invoice::find($id);
        if ($request->type == 1) {
            if ($request->confirm == 1) {
                $invoice->status += 1;
                $invoice->save();
                foreach ($invoice->invoice_item as $item) {
                    $variant = $item->product_variant;
                    $variant->stock = $variant->stock - $item->qty;
                    $variant->save();
                }
            } else {
                $invoice->status = 0;
                $invoice->image = null;
                $invoice->save();
            }
        } else if ($request->type == 2) {
            $invoice->status += 1;
            $invoice->save();
        }
        return redirect()->route('store.transaction');
    }

    public function indexUser()
    {
        $user = Auth::user();
        $invoices = $user->invoice;
        return view('pages.user.transaction', compact('invoices'));
    }

    public function editUser($transaction_id)
    {
        $user = Auth::user();
        $invoice = Invoice::find($transaction_id);
        return view('pages.user.transaction-edit', compact('invoice'));
    }

    public function updateUser($id, Request $request)
    {
        $invoice = Invoice::find($id);
        if ($request->type == 0) { // upload image
            if ($request->has('image')) {
                $product_image = $request->image;
                $filename = time() . "." . $product_image->getClientOriginalExtension();
                $product_image->move('images/receipt/', $filename);
                $invoice->image = $filename;
                $invoice->status += 1;
                $invoice->save();
            }
        } else if ($request->type == 3) { // add item to reviews
            $invoice->status += 1;
            $invoice->save();

            foreach ($invoice->invoice_item as $item) {
                $review = new Review;
                $review->user_id = Auth::user()->id;
                $review->product_id = $item->product_id;
                $review->variant_id = $item->variant_id;
                $review->qty = $item->qty;
                $review->save();
            }
        }
        return redirect()->route('user.transaction');
    }
}
