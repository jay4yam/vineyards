<?php

namespace App\Models;

use App\Models\Properties\Property;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agency extends Model
{
    use HasFactory, Uploadable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'agencies';

    protected $fillable = [
        'id',
        'is_christies',
        'is_active',
        'name',
        'address',
        'postal',
        'city_id',
        'country',
        'region',
        'latitude',
        'longitude',
        'email',
        'phone',
        'fax',
        'logo',
        'logo_svg',
        'picture'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_christies' => 'boolean'
    ];

    /**
     * Relation Agence / Utilisateurs (liste des utilisateurs appartenant à une agence)
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'agency_id', 'id');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'agency_id');
    }

    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
