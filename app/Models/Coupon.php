<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Eloquent as Model;
use Rinvex\Subscriptions\Models\Plan;

class Coupon extends Model
{
    public $table = 'coupons';

    public $fillable = [
        'name',
        'description',
        'target',
        'type',
        'discount',
        'available_uses',
        'uses_count',
        'is_active',
        'code',
        'start_at',
        'end_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'target' => 'string',
        'type' => 'string',
        'discount' => 'float',
        'available_uses' => 'integer',
        'uses_count' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required',
        'target' => 'required',
        'type' => 'required',
        'discount' => 'required|numeric',
        // 'available_uses' => 'sometimes|integer',
        // 'uses_count' => 'sometimes|integer',
        // 'is_active' => 'required'
    ];


    public function stores()
    {
        return $this->belongsToMany(\App\Models\UserStore::class, 'coupons_stores', 'coupon_id', 'store_id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'coupons_products', 'coupon_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'coupons_categories', 'coupon_id', 'category_id');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'coupons_plans', 'coupon_id', 'plan_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupons_users', 'coupon_id', 'user_id');
    }




    public function setStartAtAttribute($start_at)
    {
        $this->attributes['start_at'] = Carbon::parse($start_at);
    }

    public function setEndAtAttribute($end_at)
    {
        $this->attributes['end_at'] = Carbon::parse($end_at);
    }



    public function isValid($target = null)
    {
        $user = auth('api')->check() ? auth('api')->user() : auth()->user();
        // If is targeted to user, dont allow anyone else
        if ($this->users->count()) {
            if (!$this->users->firstWhere('id', $user->id)) {
                return false;
            }
        }

        if ($target) {
            if ($this->target != $target) {
                return false;
            }
        }

        if ($this->available_uses) {
            $used = $this->uses_count ?? 0;
            if ($this->available_uses <= $used) {
                return false;
            }
        }

        if (!$this->is_active) {
            return false;
        }

        if (Carbon::parse($this->start_at)->startOfDay() > Carbon::now()->startOfDay()) {
            return false;
        }

        if (Carbon::parse($this->end_at)->startOfDay() < Carbon::now()->startOfDay()) {
            return false;
        }

        return true;
    }


    public function hasFilters()
    {
        if ($this->target == 'products') {
            return $this->products->count() || $this->stores->count();
        } else if ($this->target == 'plans') {
            return $this->plans->count();
        }
    }


    public function getCalculatedDiscountValue(float $val)
    {
        switch ($this->type) {
            case 'percentage':
                return round(($val / 100) * $this->discount, 2);
                break;

            default:
                return $this->discount;
                break;
        }
    }
}