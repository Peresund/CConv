<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

	public $timestamps = false;
	
	function scopeWithCode($query, $code) {
		return $query->where('iso_4217', '=', $code);
	}
}
