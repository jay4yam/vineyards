<?php

namespace App\Models\Properties;

use App\Models\Catalogs\Property_Areas;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    public $timestamps = false;

    protected $fillable = ['property_area_id', 'number', 'area', 'property_flooring_id', 'floor', 'orientations', 'comments', 'property_id'];

    public function areaType()
    {
        return $this->belongsTo(Property_Areas::class, 'property_area_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
