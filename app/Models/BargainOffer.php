<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class BargainOffer
 * @package App\Models
 * @version July 2, 2019, 2:50 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer bargain_id
 * @property integer user_id
 * @property string status
 * @property float value
 */
class BargainOffer extends Model
{

    public $table = 'bargain_offers';
    


    public $fillable = [
        'bargain_id',
        'user_id',
        'status',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bargain_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'string',
        'value' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bargain_id' => 'required',
        'user_id' => 'required'
    ];

    
}
