<?php

namespace App\Models\Properties;

use App\traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory, Uploadable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'pictures';

    public $timestamps = false;

    protected $fillable = ['id', 'rank', 'url', 'name', 'width_max', 'height_max', 'internet', 'printer', 'child', 'reference', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'id', 'property_id');
    }
}
