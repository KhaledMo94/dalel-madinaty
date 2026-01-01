<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Area extends Model
{
    use HasTranslations, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'city_id',
    ];

    public $translatable = ['name', 'description'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function listingBranches()
    {
        return $this->hasMany(ListingBranch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
