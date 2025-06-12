<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    protected $appends = ['logo_path'];

    public $translatedAttributes = [
        'system_name','about_us_title','about_us_description','address','meta_description','terms','privacy'
    ];

    public function getLogoPathAttribute()
    {
        return route('file_show', [$this->logo, 'settings']);
    }
}
