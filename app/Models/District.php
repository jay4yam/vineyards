<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    public $incrementing = false;

    protected $fillable = ['id', 'name', 'slug'];

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
