<?php

namespace App\Models;

use App\Models\Properties\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    public $incrementing = false;

    protected $fillable = ['id', 'name', 'slug'];

    public $timestamps = false;

    public function properties()
    {
        return $this->belongsTo(Property::class);
    }
}
