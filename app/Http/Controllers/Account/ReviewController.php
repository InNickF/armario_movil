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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\ReviewRepository;
use App\Http\Requests\Admin\CreateReviewRequest;
use App\Http\Requests\Admin\UpdateReviewRequest;

class ReviewController extends \App\Http\Controllers\Controller
{
    /** @var  ReviewRepository */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }


    public function index()
    {
        $reviews = Review::where('user_id', Auth::user()->id)->get();
        return view('account.reviews.index', compact('reviews'));
    }



    /**
     * Show the form for editing the specified Review.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('Review no encontrad@');

            return redirect(route('account.reviews.index'));
        }

        return view('account.reviews.edit', compact('review'));
    }


    public function update($id, UpdateReviewRequest $request)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('Review no encontrad@');

            return redirect(route('account.reviews.index'));
        }

        $review = $this->reviewRepository->update($request->all(), $id);

        alert()->success('Review actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified Review from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('Review no encontrad@');

            return redirect(route('account.reviews.index'));
        }

        $this->reviewRepository->delete($id);

        alert()->success('Review eliminad@ exitosamente.');

        return redirect(route('account.reviews.index'));
    }
}