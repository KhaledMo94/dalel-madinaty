<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasTranslations, HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public $translatable = ['name', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_option');
    }

    public function optionValues()
    {
        return $this->hasMany(OptionValue::class);
    }
}
