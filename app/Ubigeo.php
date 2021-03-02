<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model {
	protected $casts = [
		'id' => 'integer',
		'ubigeo' => 'string',
		'state' => 'string',
		'city' => 'string',
		'district' => 'string',
		'location' => 'string',
		'postal_code' => 'integer',
		'agency' => 'string',
		'agency_number' => 'integer',
	];

	// public function getStates() {
	//     return $this->pluck('state')->unique();
	// }

	// public function getCities() {
	//     return $this->pluck('city')->unique();
	// }

	// public function getDistricts() {
	//     return $this->pluck('city')->unique();
	// }

}
