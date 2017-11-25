<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

	public $timestamps = false;
	
    protected $fillable = [
        'iso_4217', 'name', 'rate',
    ];
	
	public function scopeWithCode($query, $code) {
		return $query->where('iso_4217', '=', $code);
	}
	
	public function getOrdered($order) {
		
	}
}
