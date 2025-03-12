<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Model;

class Construction_Step extends Model
{
	protected $table = "catalog_construction_step";

	public $incrementing = false;

	public $timestamps = false;

	protected $fillable = ['id', 'locale', 'name', 'name_plurial'];

	public function scopeLocale($query)
	{
		return $query->where('locale', '=', app()->getLocale());
	}
}