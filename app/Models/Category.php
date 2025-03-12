<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->morphedByMany(Blog::class, 'categorizable');
    }
}
