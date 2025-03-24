<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListeSeo_Translate extends Model
{
    protected $table = 'seo_listes_translates';

    protected $fillable = ['locale', 'meta_title_seo', 'meta_description_seo', 'header_h1', 'intro', 'content', 'seo_liste_id'];

    public $timestamps = false;

    public function liste(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ListeSeo::class, 'seo_liste_id', 'id');
    }
}
