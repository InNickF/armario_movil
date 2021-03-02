<?php

namespace App\Models;

use App\Models\Slide;
use Eloquent as Model;
use App\Models\Category;

/**
 * Class Slider
 * @package App\Models
 * @version September 27, 2019, 4:23 pm -05
 *
 * @property string name
 * @property string position
 * @property string height
 * @property string width
 */
class Slider extends Model
{

    public $table = 'sliders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'position',
        'height',
        'width',
        'category_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'position' => 'string',
        'height' => 'string',
        'width' => 'string',
        'category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'position' => 'required',
    ];


    public function slides() {
        return $this->hasMany(Slide::class)->orderBy('order', 'asc');
    }


    public function category() {
        return $this->belongsTo(Category::class);
    }

    
}
