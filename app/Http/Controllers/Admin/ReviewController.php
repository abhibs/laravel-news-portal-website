<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function pendingReview()
    {

        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('admin.review.pending_review', compact('review'));
    }

    public function approvingReview($id)
    {

        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('approved-reviews')->with($notification);


    }

    public function approvedReview()
    {
        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.review.approved_review', compact('review'));
    }

    public function deleteReview($id)
    {
        Review::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}