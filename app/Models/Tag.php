<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

class Tag extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tags';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }

    /**
     * Retourne uniquement les categories dans la longue de l'application
     * @param Builder $query
     * @return mixed
     */
    public function scopeLocale(Builder $query)
    {
        return $query->where('locale', '=', App::getLocale());
    }
}
