<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Str;


class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('cando:list cars')->only(['index']);
        $this->middleware('cando:add car')->only(['create', 'store']);
        $this->middleware('cando:edit car')->only(['edit', 'update']);
        $this->middleware('cando:delete car')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Car::all();
            return Datatables::of($query)
                ->editColumn('id', function ($query) {
                    return $query->id;
                })
                ->editColumn('name', function ($query) {
                    return $query->title;
                })

                ->editColumn('category', function ($query) {
                    return $query->category->title;
                })

                ->editColumn('price', function ($query) {
                    return $query->price;
                })
                
                ->addColumn('action', function ($query) {

                    if (auth()->user()->can('edit car')) {
                        $edit = ' <a class="dropdown-item" href="' . route('cars.edit', $query->id) . '""
                        ><i class="bx bx-edit-alt me-1"></i>' . getTranslatedWords('edit') . '</a
                      >';
                    } else {
                        $edit = '';
                    }


                    if (auth()->user()->can('delete car')) {
                        $delete =
                            '<a class="dropdown-item delete_modal" data-id="' . $query->id . '" href="javascript:void(0);"
                        data-bs-toggle="modal" data-bs-target="#delete"
                        ><i class="bx bx-trash me-1"></i> ' . getTranslatedWords('delete') . '</a
                      >';
                    } else {
                        $delete = '';
                    }

                    $actioinView = '<div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">' . $edit . $delete . '</div></div>';




                    return $actioinView;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.cars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'price'=>'required|numeric',
            'year_model'=>'required|numeric|digits:4',
            'category_id'=>'required',
            'images' => 'required',
            'images.*' => 'required|image|max:2024',
            'kilometers'=>'nullable|numeric',
        ]);

        validate_trans($request, [
            ['title', 'required'],
            ['description', 'required'],
            ['model','required'],
            /*['key','nullable'],
            ['key.*','required_with:value.*'],
            ['value','nullable'],
            ['value.*','required_with:key.*'],*/
        ]);

        //dd($request->all());


        $except=[];
        $except[]='images';
        foreach(getLanguages() as $lang){
            $keys='key:'.$lang;
            $values='value:'.$lang;
            $except[]=$keys;
            $except[]=$values;
        }
        $data = $request->except($except);
        $data['slug:ar']=Str::slug($data['title:ar']);
        $arabic='meta_keywords:ar';
        $data['meta_keywords:ar']=implode(',', $request->$arabic);
        $images=[];
        if ($request->has('images')) {
            
            foreach ($request->images as $i) {
                $img = upload_multiple_image($request, $i, 980, 490, 'cars');
                $images[]=$img;
                
            }
           
        }
        $row = Car::create($data);

        foreach(getLanguages() as $lang){
            $keys='key:'.$lang;
            $values='value:'.$lang;
            if($request->$keys!=''){
                foreach($request->$keys as $k=> $t){
                   if($t!='' && $request->$values[$k]!=''){
                        $row->attributes()->create([
                            $keys=>$t,
                            $values=>$request->$values[$k],
                        ]);
                   }
                    
                }
                
            }
        }

        return redirect()->to(route('cars.index'))->with('success', getTranslatedWords('created successfully'));

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
        $row = Car::findOrFail($id);
        return view('dashboard.cars.edit')->with(compact('row'));
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
            'price'=>'required|numeric',
            'year_model'=>'required|numeric|digits:4',
            'category_id'=>'required',
            'images' => 'nullable',
            'images.*' => 'nullable|image|max:2024',
            'kilometers'=>'nullable|numeric',
        ]);

        validate_trans($request, [
            ['title', 'required'],
            ['description', 'required'],
            ['model','required'],
            /*['key','nullable'],
            ['key.*','required_with:value.*'],
            ['value','nullable'],
            ['value.*','required_with:key.*'],*/
        ]);


        $row = Car::findOrFail($id);
        $except=[];
        $except[]='images';
        foreach(getLanguages() as $lang){
            $keys='key:'.$lang;
            $values='value:'.$lang;
            $except[]=$keys;
            $except[]=$values;
        }
        $data = $request->except($except);
        $data['slug:ar']=Str::slug($data['title:ar']);
        $arabic='meta_keywords:ar';
        $data['meta_keywords:ar']=implode(',', $request->$arabic);
        if($request->images){
            if($row->images!=''&&count(json_decode($row->images))>0){
                $images=[];
                foreach ($request->images as $i) {
                    $img = upload_multiple_image($request, $i, 600, 701, 'cars');
                    $images[]=$img;
                    
                }
                $row->images=json_encode(array_merge(json_decode($row->images),$images));
                $row->save();
            }
            else {
                $images=[];
                foreach ($request->images as $i) {
                    $img = upload_multiple_image($request, $i, 600, 701, 'cars');
                    $images[]=$img;
                    
                }
                
                $row->images=json_encode($images);
                $row->save();
            }
           
        }
       
        $row->update($data);
        $row->attributes()->delete();
        foreach(getLanguages() as $lang){
            $keys='key:'.$lang;
            $values='value:'.$lang;
            if($request->$keys!=''){
                foreach($request->$keys as $k=> $t){
                   if($t!='' && $request->$values[$k]!=''){
                        $row->attributes()->create([
                            $keys=>$t,
                            $values=>$request->$values[$k],
                            //'locale'=>$lang
                        ]);
                   }
                    
                }
                
            }
        }
        return redirect()->to(route('cars.index'))->with('success', getTranslatedWords('edited successfully'));
    }

    public function destroy($id)
    {
        $row = Car::findOrFail($id);
        $row->delete();
        return redirect()->to(route('cars.index'))->with('success', getTranslatedWords('deleted successfully'));

    }

    public function delete_car_image(Request $request, $id){
        $car=Car::findOrFail($id);
        return delete_car_image($car,'images',$request->key);
    }
}
