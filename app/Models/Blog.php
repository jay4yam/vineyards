<?php

namespace App\Models;

use App\View\Composers\BlogComposer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

class Blog extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'blogs';

    protected $fillable = ['image', 'is_active', 'user_id'];

    public function translates(): HasMany
    {
        return $this->hasMany(Blog_Translate::class, 'blog_id', 'id');
    }

    public function translate(): HasOne
    {
        return $this->hasOne(Blog_Translate::class, 'blog_id', 'id')
            ->where('locale', '=', app()->getLocale() );
    }

    /**
     * Lien vers les utilisateurs
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Liens vers les tags
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tags_translates():MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->where('locale', '=', app()->getLocale());
    }

    /**
     * Liens vers les categories
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Liens vers les categories
     * @return MorphToMany
     */
    public function category(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable')
            ->where('locale', '=', app()->getLocale() );
    }
}
