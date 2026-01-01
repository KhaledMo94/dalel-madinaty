<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{

    use HasTranslations, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public $translatable = ['name', 'description'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function listingBranches()
    {
        return $this->hasManyThrough(ListingBranch::class, Area::class);
    }
}
