<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'categories';

    protected $fillable = ['name', 'locale'];

    public function posts()
    {
        return $this->morphedByMany(Blog::class, 'categorizable');
    }

    /**
     * Retourne uniquement les categories dans la longue de l'application
     * @param $query
     * @return mixed
     */
    public function scopeLocale(Builder $query)
    {
        return $query->where('locale', '=', App::getLocale());
    }
}
