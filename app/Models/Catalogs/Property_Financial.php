<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Model;

class Property_Financial extends Model
{
	protected $table = "catalog_property_financial";

	public $incrementing = false;

	public $timestamps = false;

	protected $fillable = ['id', 'locale', 'name', 'name_plurial'];

	public function scopeLocale($query)
	{
		return $query->where('locale', '=', app()->getLocale());
	}
}