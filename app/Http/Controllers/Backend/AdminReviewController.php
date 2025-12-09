<?php

namespace App\Controllers\Backend;

use App\DataTables\AdminReviewDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(AdminReviewDataTable $datatable)
    {
        return $datatable->render('admin.products.reviews.index');
    }

    public function changeStatus(Request $request)
    {
        $review = ProductReview::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();


        return response()->json(['message' => 'Review Status Changed Successfully!']);
    }
}
