<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Properties\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'slug_firstname',
        'lastname',
        'slug_lastname',
        'username',
        'role',
        'job_title',
        'mobile',
        'phone',
        'email',
        'linkedin_profile_url',
        'facebook_profile_url',
        'youtube_profile_url',
        'instagram_profile_url',
        'avatar',
        'biography',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function fullname():Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['firstname'].' '.$attributes['lastname'] ,
        );
    }

    public function scopeRedactor(Builder $query)
    {
        return $query->whereIn('role', ['admin','broker']);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Lie un utilisateur et les articles de blogs
     * @return HasMany
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

    /**
     * Lie un utilisateur et les produits du site.
     * @return HasMany
     */
    public function properties():HasMany
    {
        return $this->hasMany(Property::class, 'user_id', 'id');
    }
}
