<?php

namespace App\Models;

use App\Models\Post;
use Eloquent as Model;
use App\Models\Article;
use Nestable\NestableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class PostCategory
 * @package App\Models
 * @version August 27, 2019, 12:58 pm -05
 *
 * @property string name
 * @property string description
 */
class PostCategory extends Model implements HasMedia
{
    use NestableTrait;
    use HasMediaTrait;
    use HasSlug;

    public $table = 'post_categories';
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public $appends = [
        'url'
    ];

    public $fillable = [
        'name',
        'description',
        'slug',
        'order',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'required'
    ];



    public function getAllMedia()
    {
        return Media::whereModelType('App\Models\ArticleCategory')->whereModelId($this->id)->get();
    }


    public function saveIconImage($path)
    {   
        if(strpos($path, 'http') === false) { // ! ignore if is an URL instead of path because it would be placeholder
            $this->addMedia(public_path('storage/' . $path))
                    ->withCustomProperties(['isIcon' => true])
                    ->toMediaCollection('post_categories');
        }
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

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_post_categories', 'category_id', 'post_id');
    }


    public function getUrlAttribute()
    {

        // if (!$this->store) {
        //     return url('/');
        // }
        $slug = $this->slug;
        return url('blog/categorias/' . $slug);
    }

    
}
