<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ListeSeo extends Model
{
    protected $table = 'seo_listes';

    protected $fillable = ['name', 'slug', 'property_prefix_codes', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'property_prefix_codes' => 'array'
    ];

    /**
     * Gère la relation des traductions
     * @return HasMany
     */
    public function translates(): HasMany
    {
        return $this->hasMany(ListeSeo_Translate::class, 'seo_liste_id', 'id');
    }

    /**
     * Gère la traduction via la langue de l'application
     * @return HasOne
     */
    public function translate(): HasOne
    {
        return $this->hasOne(ListeSeo_Translate::class, 'seo_liste_id', 'id')
            ->where('locale', '=', app()->getLocale() );
    }
}
