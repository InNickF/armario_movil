<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Review;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\ReviewRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\API\CreateReviewAPIRequest;
use App\Http\Requests\API\UpdateReviewAPIRequest;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;

/**
 * Class ReviewController
 * @package App\Http\Controllers\API
 */

class ReviewAPIController extends \App\Http\Controllers\Controller
{
    /** @var  ReviewRepository */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }

    public function index(Request $request)
    {
        $reviews = QueryBuilder::for(Review::class)
                ->allowedIncludes('user', 'product')
                ->allowedFilters('body', 'reviewable_id', 'reviewable_type', Filter::scope('store_id'))
                ->defaultSort('created_at')
                ->allowedSorts('created_at')
                ->paginate($request->query('limit'));

        return $reviews;
    }

    // Create or edit review
    public function update($reviewId, UpdateReviewAPIRequest $request)
    {
        $input = $request->all();
        
        if($input['reviewable_type'] == 'OrderItem') {
            $input['reviewable_type'] = 'App\Models\OrderItem';
        }
        /** @var Review $review */
        $review = Review::find($reviewId);
        
        if (!$review) {
            // If new add initial attributes
            $input['reviewable_id'] = $request->get('order_item_id');
            $input['user_id'] = auth('api')->user()->id;
            $review = Review::create($input);
        } else {
            $review = $this->reviewRepository->update($input, $reviewId);
        }

        return $this->sendResponse($review->toArray(), 'Review updated successfully');
    }

    
}
