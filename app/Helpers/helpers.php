<?php

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Storage;

function show_file($filename = null, $path = null)
{
    return response()->file(storage_path('app/public/' . $path . '/' . $filename));
}

function download_file($filename = null, $path = null)
{
    return response()->download(storage_path('app/public/' . $path . '/' . $filename));
}

function settings($attr = "")
{
    if (Setting::first()->$attr) {
        return Setting::first()->$attr;
    } else {
        return '';
    }
}

if (!function_exists('validate_trans')) {
    function validate_trans(Request $request, $params)
    {
        $validate = [];
        //foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
        /*foreach (['ar','en'] as $l) {*/
            foreach (['ar'] as $l) {
            foreach ($params as $param) {
                
                $validate["$param[0]:$l"] = "$param[1]";
                
                //$validate["$param[0]:$l->code"]  = "$param[1]";
            }
        }
        $request->validate($validate);
    }
}

if (!function_exists('validator_trans')) {
    function validator_trans(Request $request, $params)
    {
        $validate = [];
        //foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
        foreach (App\Models\Language::get() as $l) {
            foreach ($params as $param) {
                if ($l->is_default == 1) {
                    $validate["$param[0]:$l->code"] = "$param[1]";
                }
                //$validate["$param[0]:$l->code"]  = "$param[1]";
            }
        }

        return Validator::make($request->all(), $validate);
        //$request->validate($validate);
    }
}

function upload_image(Request $request, $name, $width, $height, $path)
{
    $image = $request->$name;
    $filename = mt_rand(1000, 10000) . time() . uniqid() . '.' . $image->getClientOriginalExtension();

    $image_array = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
    if (in_array($image->getClientOriginalExtension(), $image_array)) {
        $path = storage_path('app/public/' . $path . '/' . $filename);
        if ($width != '' && $height != '') {
            Image::make($image->getRealPath())->resize($width, $height)->save($path);
        } else {
            Image::make($image->getRealPath())->save($path);
        }
    } else {
        //$image->move($path);
        //$image->store($path);
        \Storage::disk('public')->putFileAs($path, $image, $filename);
    }


    return $filename;
}

function upload_multiple_image(Request $request, $name, $width, $height, $path)
{
    //$image = $request->$name;
    $filename = mt_rand(1000, 10000) . time() . uniqid() . '.' . $name->getClientOriginalExtension();
    $path = storage_path('app/public/' . $path . '/' . $filename);
    if ($width != '' && $height != '') {
        Image::make($name->getRealPath())->resize($width, $height)->save($path);
    } else {
        Image::make($name->getRealPath())->save($path);
    }
    //Image::make($name->getRealPath())->resize($width, $height)->fit($width, $height)->save($path);
    return $filename;
}

function set_env(string $key, string $value, $env_path = null)
{
    $value = preg_replace('/\s+/', '', $value); //replace special ch
    $key = strtoupper($key); //force upper for security
    $env = file_get_contents(base_path('.env')); //fet .env file
    $env = str_replace("$key=" . env($key), "$key=" . $value, $env); //replace value
    /** Save file eith new content */
    $env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
}

function getTranslatedWords($word)
{
    $locale = app()->getLocale();
    $file = base_path("lang/{$locale}.json");

    // If file doesn't exist, create an empty JSON file
    if (!File::exists($file)) {
        File::put($file, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $translations = json_decode(File::get($file), true);
    if (!isset($translations[$word])) {
        $translations[$word] = $word;
        File::put($file, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    return $translations[$word];
}

function getTranslatedWordsTranslatedByCode($word,$lang)
{
    
    $file = base_path("lang/{$lang}.json");

    // If file doesn't exist, create an empty JSON file
    if (!File::exists($file)) {
        File::put($file, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $translations = json_decode(File::get($file), true);
    if (!isset($translations[$word])) {
        $translations[$word] = $word;
        File::put($file, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    return $translations[$word];
}




function delete_product_image(App\Models\Product $product,$field_name,$image){
    $file_name = $image;
    if(empty($file_name)) return;
    $path=storage_path('app/public/products/');
    $file = $path.$file_name;
    if(!file_exists($file)) return;
    if($image){
        $images = json_decode($product->$field_name);
        $key = array_search($image, $images);
        
        unset($images[$key]);
        @unlink($file);
        $product->$field_name=json_encode(array_values($images));
        $product->save();
        return true;
    }
    else {
        return;
    }
    return false;
   
}

function getLanguages(){
    return ['ar'];
}
