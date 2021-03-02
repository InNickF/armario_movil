<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Article
 * @package App\Models
 * @version April 4, 2019, 10:10 pm UTC
 *
 * @property string title
 * @property string body
 */
class Article extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasSlug;
    public $table = 'articles';

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public $fillable = [
        'title',
        'slug',
        'body',
        'description'
    ];

    public $appends = [
        'main_image',
        'all_media'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'plan_id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'body' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'plan_id' => 'required',
        'title' => 'required',
        'body' => 'required',
    ];

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'articles_article_categories', 'article_id', 'category_id');
    }

    public function getAllMedia()
    {
        return Media::whereModelType('App\Models\Article')->whereModelId($this->id)->get();
    }

    public function getMainImageAttribute()
    {
        $images = $this->getAllMedia();
        $default = 'https://loremflickr.com/600/800/clothes';

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isMain')) {
                return $image->getFullUrl();
            }
        }

        return $default;
    }

    public function getAllMediaAttribute()
    {
        return $this->getAllMedia();
    }


    public function saveMainImage($path)
    {
        $this->addMedia(public_path('storage/' . $path))
            ->withCustomProperties(['isMain' => true])
            ->toMediaCollection('articles');
    }
}