<?php

namespace App\Controllers\Frontend;

use App\DataTables\UserProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductReviewRequest;
use App\Models\ProductReview;
use App\Services\ProductReviewService;
use Illuminate\Database\Eloquent\Model;

class ReviewController extends Controller
{
    public function index(UserProductReviewDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.reviews.index');
    }

    public function __construct(
        protected ProductReviewService $service
    ) {}

    public function store(StoreProductReviewRequest $request)
    {
        try {
            $this->service->store($request->validated());

            notify()->success("Your review has been submitted successfully!");
        } catch (\Exception $e) {
            notify()->error($e->getMessage());
        }

        return redirect()->back();
    }
}
