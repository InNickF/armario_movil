<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\User;
use Response;
use App\Models\Store;
use App\Models\Product;
use App\Models\UserStore;
use App\Http\Requests\Admin;
use App\DataTables\Admin\ReviewDataTable;
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

    /**
     * Display a listing of the Review.
     *
     * @param ReviewDataTable $reviewDataTable
     * @return Response
     */
    public function index(ReviewDataTable $reviewDataTable)
    {
        return $reviewDataTable->render('admin.reviews.index');
    }

    /**
     * Show the form for creating a new Review.
     *
     * @return Response
     */
    public function create()
    {   
        $stores = UserStore::all();
        $products = Product::all();
        $users = User::all();
        return view('admin.reviews.create', compact('stores', 'products', 'users'));
    }

    /**
     * Store a newly created Review in storage.
     *
     * @param CreateReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateReviewRequest $request)
    {
        $input = $request->all();

        $review = $this->reviewRepository->create($input);

        alert()->success('Review saved successfully.');

        return redirect(route('admin.reviews.index'));
    }

    /**
     * Display the specified Review.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('Review no encontrad@');

            return redirect(route('admin.reviews.index'));
        }

        return view('admin.reviews.show')->with('review', $review);
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

            return redirect(route('admin.reviews.index'));
        }

        $stores = UserStore::all();
        $products = Product::all();
        $users = User::all();

        return view('admin.reviews.edit', compact('review', 'stores', 'products', 'users'));
    }

    /**
     * Update the specified Review in storage.
     *
     * @param  int              $id
     * @param UpdateReviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReviewRequest $request)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            alert()->error('Review no encontrad@');

            return redirect(route('admin.reviews.index'));
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

            return redirect(route('admin.reviews.index'));
        }

        $this->reviewRepository->delete($id);

        alert()->success('Review eliminad@ exitosamente.');

        return redirect(route('admin.reviews.index'));
    }
}
