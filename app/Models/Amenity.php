<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Amenity extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
    ];

    protected static function booted()
    {
        static::deleted(function ($amenity){
            if($amenity->image){
                Controller::deleteFile($amenity->image);
            };
        });
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'amenity_listings');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class , AmenityCategory::class);
    }
}
