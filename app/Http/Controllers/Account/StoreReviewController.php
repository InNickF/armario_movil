<?php

namespace App\Http\Controllers\Account;

use Flash;
use App\User;
use Response;
use App\Models\Store;
use App\Models\Review;
use App\Models\Product;
use App\Models\UserStore;
use App\Http\Requests\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\ReviewRepository;
use App\Http\Requests\Admin\CreateReviewRequest;
use App\Http\Requests\Admin\UpdateReviewRequest;

class StoreReviewController extends \App\Http\Controllers\Controller
{
    /** @var  ReviewRepository */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }


    public function index()
    {
        // dd(Auth::user()->store->id);
        $reviews = Review::has('user')->whereIn('reviewable_id', Auth::user()->store->getOrderItems()->get()->pluck('id'))->where('reviewable_type', 'App\Models\OrderItem')->latest()->paginate(10);
        // dd($reviews);
        return view('account.store_reviews.index', compact('reviews'));
    }

    public function edit($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('review no encontrad@');

            return redirect(route('account.store_reviews.index'));
        }

        return view('account.store_reviews.edit')->with('review', $review);
    }
}