<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        for($i=0;$i<=6;$i++){
            if($i<=2){
                $category=1;
                $price=5000;
            }
            if($i<=4 && $i>2){
                $category=2;
                $price=6000;
            }
            if($i<=6 && $i>4){
                $category=3;
                $price=7000;
            }
            $car=Car::create([
                'title:ar'=>'سيارة '.$i,
                'price'=>$price,
                'category_id'=>$category,
                'year_model'=>2010,
                'kilometers'=>$price,
                'images'=>json_encode(['white.gts04.jpg','white.gts05.jpg','white.gts06.jpg']),
            ]);
            for($x=0;$x<=6;$x++){
                $car->attributes()->create([
                    'key:ar'=>'خاصية '.$x,
                    'value:ar'=>'قيمة الخاصية '.$x
                ]);
            }
            
        }
        
    }
}
