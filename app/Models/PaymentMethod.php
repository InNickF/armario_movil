<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PaymentMethod
 * @package App\Models
 * @version March 19, 2019, 4:57 pm UTC
 *
 * @property string name
 * @property string description
 * @property string gateway_key
 * @property string gateway_user
 * @property string gateway_secret
 * @property string gateway_redirect
 * @property boolean is_collecting
 * @property boolean is_paying
 */
class PaymentMethod extends Model {

	public $table = 'payment_methods';

	public $guarded = [
		'id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'account_number' => 'string',
		'account_type' => 'string',
		'document_number' => 'string',
		'document_type' => 'string',
		'is_collecting' => 'boolean',
		'is_paying' => 'boolean',
		'is_card' => 'boolean',
		'card_token' => 'text',
		'is_primary' => 'boolean',
		'bank_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required',
		'is_collecting' => 'required',
		'is_paying' => 'required',
		'bank_id' => 'required',
	];

	public function bank() {
		return $this->belongsTo(\App\Models\Bank::class);
	}

}
