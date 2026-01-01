<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\Controller;
use App\Traits\ActivityScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, HasApiTokens, ActivityScopeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'country_code',
        'phone_verified_at',
        'email_verified_at',
        'image',
        'status',
        'fcm_token',
        'otp_code',
        'otp_expires_at',
        'commenter_id',
        'area_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'phone_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',

        ];
    }
    //-----------------------------

    protected $appends = [
        'image_url',
        'is_phone_verified',
        'phone',
        'valid',
    ];

    //-----------------------------------------------

    protected static function booted()
    {
        static::deleted(function ($user) {
            if ($user->image) {
                Controller::deleteFile($user->image);
                $user->tokens()->delete();
            };
        });
    }

    public function getPhoneAttribute()
    {
        return $this->country_code . $this->phone_number;
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getIsPhoneVerifiedAttribute()
    {
        return is_null($this->phone_verified_at) ? false : true;
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'listing_users');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function commenterListing()
    {
        return $this->belongsTo(Listing::class, 'commenter_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Scope a query to only include users who are commenters.
     */
    public function scopeCommenters($query)
    {
        return $query->whereNotNull('commenter_id');
    }

    /**
     * Scope a query to only include users who are commenters for a specific listing.
     */
    public function scopeCommentersForListing($query, $listingId)
    {
        return $query->where('commenter_id', $listingId);
    }

}
