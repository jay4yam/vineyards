<?php

namespace App\Models\Properties;

use App\Models\Catalogs\Property_Areas;
use App\Models\Catalogs\Property_Category;
use App\Models\Catalogs\Property_Subtype;
use App\Models\Catalogs\Property_Type;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    use HasFactory, Uploadable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'properties';

    protected $fillable = [
        'id', 'reference', 'agency_id', 'sector', 'user_id', 'step_id', 'status_id', 'parent_id',
        'category_id', 'subcategory_id', 'name', 'type_id', 'subtype_id', 'agreement_id',
        'block_name', 'lot_reference', 'cadastre_reference', 'address', 'address_more', 'is_published_address',
        'country', 'region_id', 'city_id', 'district_id', 'longitude', 'latitude', 'radius', 'altitude',
        'area_id', 'area_value', 'area_total', 'area_weighted', 'plot_net_floor', 'plot_floor_area',
        'rooms', 'bedrooms', 'currency', 'view_type_id', 'landscape', 'construction_method_id',
        'construction_year', 'construction_step_id', 'floor_id', 'floor_value', 'floor_level', 'floor_total',
        'heating_device_id', 'heating_access_id', 'heating_type_id', 'water_hot_device_id', 'hot_water_access_id',
        'hot_water_access_id', 'waste_water_id', 'condition_id', 'standing_id', 'style', 'facade', 'availability_id',
        'available_at', 'delivered_at', 'activities', 'orientations', 'services', 'proximities'
    ];

    /**
     * Utilisateur d'un bien
     * @return HasOne
     */
    public function user():HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Category
     * @return HasOne
     */
    public function category():HasOne
    {
        return $this->hasOne(Property_Category::class, 'id', 'category_id');
    }

    /**
     * Prix
     * @return HasOne
     */
    public function price():HasOne
    {
        return $this->hasOne(Price::class, 'property_id', 'id');
    }

    /**
     * Type de bien
     * @return HasOne
     */
    public function type():HasOne
    {
        return $this->hasOne(Property_Type::class, 'id', 'type_id')
            ->where('locale', '=',  app()->getLocale());
    }

    /**
     * Sous-type de bien
     * @return HasOne
     */
    public function subtype():HasOne
    {
        return $this->hasOne(Property_Subtype::class, 'id', 'subtype_id')
            ->where('locale', '=',  app()->getLocale());
    }

    /**
     * Retourne la ville du bien
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * Retourne la region du bien
     * @return HasOne
     */
    public function region(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    /**
     * Retourne le district du bien
     * @return HasOne
     */
    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    /**
     * Photos d'un bien
     * @return HasMany
     */
    public function pictures():HasMany
    {
        return $this->hasMany(Picture::class, 'property_id', 'id');
    }

    /**
     * Retourne la premiere photo du produit
     * @return HasOne|Model|null
     */
    public function picture(): Model|HasOne|null
    {
        return $this->hasOne(Picture::class, 'property_id', 'id')
            ->orderBy('rank');
    }

    /**
     * Les textes d'un bien
     * @return HasMany
     */
    public function comments():HasMany
    {
        return $this->hasMany(Comment::class, 'property_id', 'id');
    }

    /**
     * Texte d'un bien dans la langue du site
     * @return HasOne
     */
    public function comment():HasOne
    {
        return $this->hasOne(Comment::class, 'property_id', 'id')
            ->where('locale', '=', app()->getLocale());
    }

    /**
     * Surfaces d'un bien
     * @return HasMany
     */
    public function areas():HasMany
    {
        return $this->hasMany(Area::class, 'property_id', 'id')
            ->with(['areaType' => function ($query) {
                $query->where('locale', '=', app()->getLocale());
            }]);
    }

    /**
     * Récupère la surface du terrain
     * @return int|mixed
     */
    public function surfTerrain()
    {
        return $this->hasMany(Area::class, 'property_id', 'id')
            ->where('property_id', $this->id)
            ->whereIn('property_area_id', ['49', '50','51'])
            ->sum('area') / 10000;
    }

    /**
     * DPE et autres joyeuseté
     * @return HasMany
     */
    public function regulations():HasMany
    {
        return $this->hasMany(Regulation::class, 'property_id', 'id');
    }


}
