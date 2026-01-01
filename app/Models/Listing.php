<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use App\Traits\ActivityScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;

class Listing extends Model
{
    use HasTranslations, HasFactory, ActivityScopeTrait;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'status',
        'image',
        'banner_image',
        'file',
        'latitude',
        'longitude',
        'fb_link',
        'tt_link',
        'insta_link'
    ];


    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function branches()
    {
        return $this->hasMany(ListingBranch::class);
    }

    public function nearestListingBranch()
    {
        return $this->hasOne(ListingBranch::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'listing_users');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_listings', 'listing_id', 'amenity_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class, 'listing_option_value', 'listing_id', 'option_value_id');
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function commenterUsers()
    {
        return $this->hasMany(User::class, 'commenter_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeWithIsLiked(Builder $query, ?int $userId = null): Builder
    {
        $userId ??= Auth::guard('sanctum')->id();

        if (! $userId) {
            return $query->addSelect([
                'is_liked' => DB::raw('false')
            ]);
        }

        return $query->withExists([
            'users as is_liked' => fn ($q) =>
                $q->where('users.id', $userId)
        ]);
    }

    public function getIsLikedAttribute(): bool
    {
        return (bool) ($this->attributes['is_liked'] ?? false);
    }

}
