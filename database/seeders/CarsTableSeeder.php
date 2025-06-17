<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CarsTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        \Artisan::call( 'storage:link' );
        /*if ( !Storage::disk( 'public' )->exists( 'cars' ) ) {
            Storage::disk( 'public' )->makeDirectory( 'cars' );
        }*/
        $sourcePath = base_path( 'uploads' );
        // Full path to source folder
        $destinationPath = storage_path('app/public/cars');
        // Destination inside storage

        // Ensure the destination directory exists
        if ( !File::exists( $destinationPath ) ) {
            File::makeDirectory( $destinationPath, 0755, true );
            // true for recursive
        }

        // Copy files ( not subdirectories )
        $files = File::files( $sourcePath );

        foreach ( $files as $file ) {
            File::copy( $file->getRealPath(), $destinationPath . '/' . $file->getFilename() );
        }
        for ( $i = 0; $i <= 6; $i++ ) {
            if ( $i <= 2 ) {
                $category = 1;
                $price = 5000;
            }
            if ( $i <= 4 && $i>2 ) {
                $category = 2;
                $price = 6000;
            }
            if ( $i <= 6 && $i>4 ) {
                $category = 3;
                $price = 7000;
            }
            $car = Car::create( [
                'title:ar'=>'سيارة '.$i,
                'price'=>$price,
                'category_id'=>$category,
                'year_model'=>2010,
                'kilometers'=>$price,
                'images'=>json_encode( [ 'white.gts04.jpg', 'white.gts05.jpg', 'white.gts06.jpg' ] ),
            ] );
            for ( $x = 0; $x <= 6; $x++ ) {
                $car->attributes()->create( [
                    'key:ar'=>'خاصية '.$x,
                    'value:ar'=>'قيمة الخاصية '.$x
                ] );
            }

        }

    }
}
