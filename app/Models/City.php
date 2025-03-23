<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public $incrementing = false;

    protected $fillable = ['id', 'name', 'zipcode', 'prefix_code','slug'];

    public $timestamps = false;

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'id', 'city_id');
    }

    public function properties()
    {
        return $this->belongsTo(Property::class);
    }
}
