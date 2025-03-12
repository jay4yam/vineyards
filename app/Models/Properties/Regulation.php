<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'regulations';

    protected $fillable = ['id', 'property_regulation_id', 'value', 'date', 'label', 'image', 'graph', 'property_id'];

    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
