<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\RolesController;


use App\Http\Controllers\Front\HomeController;





/*use App\Models\Blog;
use App\Models\Faq;
use App\Models\Service;*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('show_file/{filename}/{path}', function ($filename, $path) {
    return show_file($filename, $path);
})->name('file_show');

Route::get('download_file/{filename}/{path}', function ($filename, $path) {
    return download_file($filename, $path);
})->name('download_file');



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Auth::routes();
    Route::get('admin', function () {
        if (auth()->check()) {
            return redirect(route('dashboard'));
        }

        return redirect(route('login'));

    });
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('about-us', [HomeController::class, 'about'])->name('about-us');
    Route::get('contact-us', [HomeController::class, 'contact'])->name('contact-us');
    Route::post('send-contact', [HomeController::class, 'send_contact'])->name('send-contact');
    

    Route::group(['middleware' => ['adminmw']], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
        Route::post('profile', [DashboardController::class, 'updateProfile'])->name('updateProfile');
        



       

        Route::resource('settings', SettingsController::class);
       

        Route::resource('admins', AdminsController::class);
        Route::resource('roles', RolesController::class);
        Route::get('get_permissions', [RolesController::class, 'get_permissions']);
        Route::post('show_permissions', [RolesController::class, 'show_permissions']);
        Route::get('get_permissions_per_monitor', [RolesController::class, 'get_permissions_per_monitor']);

        Route::resource('contacts', ContactsController::class);

    });

    
    
});




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
