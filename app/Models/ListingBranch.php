<?php

namespace App\Models;

use App\Models\Scopes\DistanceScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class ListingBranch extends Model
{
    use HasTranslations;

    public $translatable = [
        'address'
    ];

    protected $guarded = [];

    protected $appends = [

    ];

    protected static function booted()
    {
        if (request()->has(['latitude', 'longitude'])) {
            static::addGlobalScope(new DistanceScope(
                request()->query('latitude'),
                request()->query('longitude')
            ));
            static::addGlobalScope('sortByDistance', function (Builder $builder) {
                return $builder->orderBy('distance');
            });
        }
        if (Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->area_id) {
            static::addGlobalScope('area', function (Builder $builder) {
                $builder->orderByRaw("CASE WHEN area_id = " . Auth::guard('sanctum')->user()->area_id . " THEN 0 ELSE 1 END");
            });
        }
    }

    public function getLocationUrlAttribute()
    {
        return "https://www.google.com/maps/search/?api=1&query={$this->latitude},{$this->longitude}";
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }


}
