<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class ListingImage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'image',
        'listing_id',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
