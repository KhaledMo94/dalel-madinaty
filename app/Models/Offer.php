<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasTranslations , HasFactory;
    protected $fillable = [
        'image',
        'content',
        'start_date',
        'end_date',
        'listing_id',
        'listing_branch_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public $translatable = ['content'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function listingBranch()
    {
        return $this->belongsTo(ListingBranch::class, 'listing_branch_id');
    }

    public function getIsActiveAttribute()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

}
