<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Cacheable\CacheableEloquent;
use Illuminate\Database\Eloquent\Builder;
use Jackpopp\GeoDistance\GeoDistanceTrait;
use Rinvex\Support\Traits\ValidatingTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;



class Address extends Model
{
    use ValidatingTrait;
    use GeoDistanceTrait;
    use CacheableEloquent;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'label',
        'given_name',
        'family_name',
        'organization',
        'country_code',
        'street',
        'state',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'is_primary',
        'is_billing',
        'is_shipping',
        'is_paying',
        'is_collecting',
        'ubigeo_id',
        'document_type',
        'document_number',
        'property_number',
        'secondary_street',
        'district',
        'skip_document',
        'reference',
        'email',
        'phone'
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'addressable_id' => 'integer',
        'addressable_type' => 'string',
        'label' => 'string',
        'given_name' => 'string',
        'family_name' => 'string',
        'organization' => 'string',
        'country_code' => 'string',
        'street' => 'string',
        'state' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'latitude' => 'float',
        'longitude' => 'float',
        'is_primary' => 'boolean',
        'is_billing' => 'boolean',
        'is_shipping' => 'boolean',
        'deleted_at' => 'datetime',
        'is_paying' => 'boolean',
        'is_collecting' => 'boolean',
        'ubigeo_id' => 'integer',
        'document_type' => 'string',
        'document_number' => 'string',
        'secondary_street' => 'string',
        'property_number' => 'string',
        'reference' => 'string',
        'district' => 'string',
        'email' => 'string',
        'phone' => 'string',
    ];

    /**
     * {@inheritdoc}
     */
    protected $observables = [
        'validating',
        'validated',
    ];

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    public $rules = [
        'addressable_id' => 'required|integer',
        'addressable_type' => 'required|string|max:150',
        'label' => 'nullable|string|max:150',
        'phone' => 'nullable|string|max:10|min:10',
        'email' => 'nullable|email',
        'given_name' => 'sometimes|string|max:150',
        'family_name' => 'nullable|string|max:150',
        'organization' => 'nullable|string|max:150',
        'country_code' => 'nullable|alpha|size:2|country',
        'street' => 'nullable|string|max:150',
        'state' => 'nullable|string|max:150',
        'city' => 'nullable|string|max:150',
        'postal_code' => 'nullable|string|max:150',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'is_primary' => 'sometimes|boolean',
        'is_billing' => 'sometimes|boolean',
        'is_shipping' => 'sometimes|boolean',
        'is_paying' => 'sometimes|boolean',
        'is_collecting' => 'sometimes|boolean',
        'document_number' => 'nullable',
        'document_type' => 'nullable',
    ];

    /**
     * Whether the model should throw a
     * ValidationException if it fails validation.
     *
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('rinvex.addresses.tables.addresses'));
    }


    public function ubigeo()
    {
        return $this->belongsTo(\App\Ubigeo::class);
    }



    /**
     * Get the owner model of the address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo('addressable', 'addressable_type', 'addressable_id');
    }

    /**
     * Scope primary addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPrimary(Builder $builder): Builder
    {
        return $builder->where('is_primary', true);
    }

    /**
     * Scope billing addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsBilling(Builder $builder): Builder
    {
        return $builder->where('is_billing', true);
    }

    /**
     * Scope shipping addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsShipping(Builder $builder): Builder
    {
        return $builder->where('is_shipping', true);
    }

    /**
     * Scope addresses by the given country.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $countryCode
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCountry(Builder $builder, string $countryCode): Builder
    {
        return $builder->where('country_code', $countryCode);
    }

    /**
     * Scope addresses by the given language.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $languageCode
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInLanguage(Builder $builder, string $languageCode): Builder
    {
        return $builder->where('language_code', $languageCode);
    }

    /**
     * Get full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return implode(' ', [$this->given_name, $this->family_name]);
    }

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $address) {
            if (config('rinvex.addresses.geocoding')) {
                $segments[] = $address->street;
                $segments[] = sprintf('%s, %s %s', $address->city, $address->state, $address->postal_code);
                $segments[] = country($address->country_code)->getName();

                $query = str_replace(' ', '+', implode(', ', $segments));
                $geocode = json_decode(file_get_contents("https://maps.google.com/maps/api/geocode/json?address={$query}&sensor=false"));

                if (count($geocode->results)) {
                    $address->latitude = $geocode->results[0]->geometry->location->lat;
                    $address->longitude = $geocode->results[0]->geometry->location->lng;
                }
            }
        });
    }



    public static function cleanPrimaryAddresses($addresses)
    {
        foreach ($addresses as $key => $address) {
            if ($address->is_primary == true) {
                $address->is_primary = false;
                $address->save();
            }
        }
    }

    public function getFullAddressAttribute()
    {
        return  "$this->street & $this->secondary_street, $this->property_number, $this->reference";
    }
}