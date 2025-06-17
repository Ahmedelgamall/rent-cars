<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Car extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
      
    public $translatedAttributes = [
        'title','model','description','meta_description','meta_keywords','slug'
    ];

    public function attributes(){
        return $this->hasMany(CarAttribute::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product_images(){
        $images=[];
        if($this->images!=''){
            foreach(json_decode($this->images) as $image){
                
                $images[]=route('file_show', [$image, 'cars']);
            }
        }
       return $images;
    }
}
