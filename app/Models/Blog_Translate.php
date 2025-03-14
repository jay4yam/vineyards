<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog_Translate extends Model
{
    use HasFactory, Notifiable;

    protected $table = "blog_translations";

    protected $fillable = ['blog_id', 'locale', 'title', 'intro', 'content', 'slug', 'meta_title', 'meta_desc'];

    public function blog(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
