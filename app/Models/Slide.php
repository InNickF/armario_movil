<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Slide.
 *
 * @version September 27, 2019, 4:23 pm -05
 *
 * @property string body
 * @property string url
 * @property string button_text
 * @property string button_theme
 * @property int order
 */
class Slide extends Model implements HasMedia
{
    use HasMediaTrait;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $table = 'slides';

    public $fillable = [
        'body',
        'url',
        'button_text',
        'button_theme',
        'order',
        'slider_id',
    ];

    public $appends = [
        'image',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        // 'url' => 'required',
        // 'button_text' => 'required',
        // 'button_theme' => 'required',
        'order' => 'required',
        'slider_id' => 'sometimes',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'url' => 'string',
        'button_text' => 'string',
        'button_theme' => 'string',
        'order' => 'integer',
        'slider_id' => 'integer',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('medium')
            ->width(1200)
            ->sharpen(2)
        ;
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function saveImage($path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->toMediaCollection('slides')
        ;
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('slides', 'medium');
    }
}