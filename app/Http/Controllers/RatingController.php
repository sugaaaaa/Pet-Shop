<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateProduct(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'order_id' => 'required|integer',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Rating();
        $review->order_id = $request->order_id;
        $review->comments = $request->comment;
        $review->star_rating = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
}