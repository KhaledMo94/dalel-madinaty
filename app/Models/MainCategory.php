<?php

namespace App\Models;

use App\Traits\ActivityScopeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MainCategory extends Model
{
    use HasFactory , HasTranslations , ActivityScopeTrait;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
    ];

    public $translatable = ['name','description'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
