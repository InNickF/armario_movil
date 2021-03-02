<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Faq extends Model {

	use HasSlug;

	public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

	public $table = 'faqs';

	public $fillable = [
		'title',
		'slug',
		'description',
		'body',
		'user_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'title' => 'string',
		'body' => 'string',
		'description' => 'string',
		'user_id' => 'integer',
	];

	public $appends = [
		'url'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'title' => 'required',
		'body' => 'required',
		'description' => 'required',
	];

	public function categories() {
		return $this->belongsToMany(FaqCategory::class, 'faqs_faq_categories', 'faq_id', 'category_id');
	}

	public function user() {
		return $this->belongsTo(\App\User::class);
	}

	public function getUrlAttribute() {
		return url('preguntas-frecuentes/categorias/' . $this->slug);
	}
}
