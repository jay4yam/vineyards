<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    protected $fillable = ['value', 'currency', 'commission_owner', 'commission_customer', 'net_seller', 'property_id'];

    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
