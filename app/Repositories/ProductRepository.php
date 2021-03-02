<?php

namespace App\Repositories;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version February 27, 2019, 5:08 pm UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
 */
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'name',
        'slug',
        'description',
        'is_active',
        'has_discount',
        'quantity',
        'tax_id',
        'price',
        'category_id',
        'package_width',
        'package_height',
        'package_depth',
        'package_weight',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    public function findByPlan($planSlug)
    {
        $plan = app('rinvex.subscriptions.plan')->where('slug', $planSlug)->first();

        if(!$plan) {
            return [];
        }

        // $subscriptions_ids = app('rinvex.subscriptions.plan_subscription')
        //     ->where('user_type', 'App\Models\Product')
        //     ->where('plan_id', $plan->id)
        //     ->pluck('user_id')->toArray(); //Its called like that in DB

        $this->applyCriteria();
        $this->applyScope();

        $products = $this->model->with('subscriptions')->whereHas('subscriptions', function($sub) use ($plan) {
            $sub->where('plan_id', $plan->id);
        })->get();


        return $products;
    }
}
