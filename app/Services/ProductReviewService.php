<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductReviewService
{
    /**
     * Store a review without images.
     */
    public function store(array $data): ProductReview
    {
        $user = Auth::user();

        // ✅ Check if user purchased product
        $hasBought = Order::where('user_id', $user->id)
            ->where('order_status', 'delivered')
            ->whereHas('orderProducts', fn($q) => $q->where('product_id', $data['product_id']))
            ->exists();

        if (!$hasBought) {
            notify()->error('Only customers who have purchased this product can leave a review.');
            throw new \Exception("Only customers who purchased this product can leave a review.");
        }

        // ✅ Check if review exists
        $exists = ProductReview::where([
            'product_id' => $data['product_id'],
            'user_id'    => $user->id,
        ])->exists();

        if ($exists) {
            notify()->error('You already added a review for this product!');
            throw new \Exception("You already submitted a review for this product.");
        }

        // ✅ Create review (no images)
        return ProductReview::create([
            'product_id' => $data['product_id'],
            'user_id'    => $user->id,
            'rating'     => $data['rating'],
            'review'     => $data['review'],
            'status'     => 0, // pending
        ]);
    }
}
