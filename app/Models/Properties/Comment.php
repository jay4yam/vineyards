<?php

namespace App\Models\Properties;

use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory, Uploadable;

    protected $table = 'comments';

    public $timestamps = false;

    protected $fillable = [ 'locale', 'title', 'subtitle', 'hook', 'comment', 'comment_full', 'property_id'];

    /**
     * Rècupère le titre slugifier
     * @return Attribute
     */
    protected function slug():Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Str::slug( $attributes['title'] ),
        );
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
