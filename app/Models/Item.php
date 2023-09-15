<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Article;
use App\Models\Type;
use App\Models\Variety;
use App\Models\Brand;
use App\Models\Manufacturer;
use App\Models\Country;
use App\Models\Unit;
use App\Models\Supplier;


class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'description',
        'model',
        'details2',
        'accessories',
        'other',
        'warranty',
        'acquisition_date',
        'cost',
        'expiration'
    ];

    public $timestamps = true;

    /**
     * Get the Article Type that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article_type(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'foreign_key', 'id');
    }

    public function variety(): HasOne
    {
        return $this->hasOne(Variety::class, 'foreign_key', 'local_key');
    }

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'foreign_key', 'local_key');
    }

    public function manufacturer(): HasOne
    {
        return $this->hasOne(Manufacturer::class, 'foreign_key', 'local_key');
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'foreign_key', 'local_key');
    }

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, 'foreign_key', 'local_key');
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class, 'foreign_key', 'local_key');
    }

    /**
     * The Category that belong to the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function itemCategory(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_category', 'item_id', 'category_id');
    }

    
    //SettingsData Relationship
    public function settings()
    {
        return $this->belongsToMany('App\Models\Settings')->withPivot('settings_id');
    }

    //SettingsData Relationship
    public function settings_data()
    {
        return $this->belongsToMany('App\Models\SettingsData')->withPivot('settings_data_id');
    }

    //Conditions Relationship
    public function conditions()
    {
        return $this->belongsToMany('App\Models\Conditions')->withPivot('item_id');
    }
}
