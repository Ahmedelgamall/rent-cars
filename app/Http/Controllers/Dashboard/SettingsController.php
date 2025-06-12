<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('cando:edit settings')->only(['index','update']);
    }

    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.settings.index')->with(compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            //'system_name'=>'required',
            'email'=>'required|email',
            'phone' => 'required|numeric',
            //'whatsapp' => 'nullable|numeric',
            'logo' => 'nullable|image|max:2024',
            'about_us_image' => 'nullable|image|max:2024',
            'cover_image' => 'nullable|image|max:2024',
            'faq_image' => 'nullable|image|max:2024',
        ]);

        validate_trans($request, [
            ['system_name','required'],
        ]);
        
        $data = $request->except(['logo','about_image','cover_image','faq_image']);
        $setting = Setting::first();
        
        if ($request->has('logo')) {
            $image = upload_image($request, 'logo', 159, 38, 'settings');
            $data['logo'] = $image;
        }

        if ($request->has('about_image')) {
            $image = upload_image($request, 'about_image', 1140, 1210, 'settings');
            $data['about_image'] = $image;
        }

        if ($request->has('cover_image')) {
            $image = upload_image($request, 'cover_image', 1920, 404, 'settings');
            $data['cover_image'] = $image;
        }

        if ($request->has('faq_image')) {
            $image = upload_image($request, 'faq_image', 600, 600, 'settings');
            $data['faq_image'] = $image;
        }

        
        
         
        $setting->update($data);
        return redirect()->to(route('settings.index'))->with('success',getTranslatedWords('edited successfully'));
    }
}