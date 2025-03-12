<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'tags_customized';

    protected $fillable = ['id', 'locale', 'label', 'value'];

    public $timestamps = false;

    /**
     * Lie les tags au propriétés
     * @return BelongsToMany
     */
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_tag', 'tag_id', 'property_id');
    }
}
