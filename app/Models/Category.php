<?php

namespace App\Models;

use App\Traits\ActivityScopeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory , HasTranslations , ActivityScopeTrait;
    protected $fillable = [
        'name',
        'description',
        'main_category_id',
        'image',
        'status',
    ];

    public $translatable = ['name','description'];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class , AmenityCategory::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'category_option');
    }

}
