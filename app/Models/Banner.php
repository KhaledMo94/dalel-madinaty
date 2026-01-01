<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasTranslations, HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'listing_id',
    ];

    public $translatable = ['title'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
