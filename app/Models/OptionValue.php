<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OptionValue extends Model
{
    use HasTranslations, HasFactory;
    protected $table = 'option_values';
    protected $fillable = [
        'name',
        'option_id',
    ];

    public $translatable = ['name'];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
