<?php

namespace App\Models;

use App\Models\Faq;
use Eloquent as Model;
use Nestable\NestableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class FaqCategory extends Model implements HasMedia
{
    use NestableTrait;
    use HasMediaTrait;
    use HasSlug;

    public $table = 'faq_categories';
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
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
        'description' => 'string',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'order' => 'required|unique',
    ];

    public $appends = [
        'icon_image',
    ];

    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'faqs_faqs_categories', 'category_id', 'faq_id');
    }






    public function getAllMedia()
    {
        return Media::whereModelType('App\Models\FaqCategory')->whereModelId($this->id)->get();
    }


    public function saveIconImage($path)
    {
        $this->addMedia(public_path('storage/' . $path))
                ->withCustomProperties(['isIcon' => true])
                ->toMediaCollection('faqs');
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


    public function getUrlAttribute() {
		return url('preguntas-frecuentes/categorias/' . $this->slug);
	}

    
}
