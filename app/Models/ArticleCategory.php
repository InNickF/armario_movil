<?php

namespace App\Models;

use Eloquent as Model;
use Nestable\NestableTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Rinvex\Subscriptions\Models\Plan;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class ArticleCategory
 * @package App\Models
 * @version April 4, 2019, 10:14 pm UTC
 *
 * @property string name
 * @property string description
 */
class ArticleCategory extends Model implements HasMedia
{
    use NestableTrait;
    use HasMediaTrait;
    use HasSlug;
    
    public $table = 'article_categories';
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public $fillable = [
        'name',
        'description',
        'slug',
        'order',
        'plan_id'
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
        'slug' => 'string',
        'order' => 'integer',
        'plan_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'order' => 'required|unique',
        'plan_id' => 'required'
    ];


    public function getAllMedia()
    {
        return Media::whereModelType('App\Models\ArticleCategory')->whereModelId($this->id)->get();
    }


    public function saveIconImage($path)
    {   
        $this->addMedia(public_path('storage/' . $path))
                ->withCustomProperties(['isIcon' => true])
                ->toMediaCollection('articles');
    }

    public function getIconImageAttribute()
    {
        $images = $this->getAllMedia();
        $default = 'https://placehold.it/40x40';

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isIcon')) {
                return $image->getFullUrl();
            }
        }

        return $default;
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    
}
