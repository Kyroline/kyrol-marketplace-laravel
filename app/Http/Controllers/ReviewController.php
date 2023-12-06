<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index () {
        $reviews = Auth::user()->review;
        return view('pages.user.review', compact('reviews'));
    }

    public function update (Request $request) {
        $review = Review::find($request->review_id);
        $review->score = $request->score;
        $review->review = $request->description;
        $review->save();
    }
}
