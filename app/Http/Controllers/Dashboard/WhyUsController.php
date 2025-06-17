<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\WhyChooseUs;
use Str;


class WhyUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = WhyChooseUs::all();
            return Datatables::of($query)
                ->editColumn('id', function ($query) {
                    return $query->id;
                })
                ->editColumn('title', function ($query) {
                    return $query->title;
                })

               


                ->addColumn('action', function ($query) {


                    $edit = ' <a class="dropdown-item" href="' . route('why-us.edit', $query->id) . '""
                        ><i class="bx bx-edit-alt me-1"></i>' . getTranslatedWords('edit') . '</a
                      >';




                    $delete =
                        '<a class="dropdown-item delete_modal" data-id="' . $query->id . '" href="javascript:void(0);"
                        data-bs-toggle="modal" data-bs-target="#delete"
                        ><i class="bx bx-trash me-1"></i> ' . getTranslatedWords('delete') . '</a
                      >';


                    $actioinView = '<div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">' . $edit . $delete . '</div></div>';


                    return $actioinView;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.why-us.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.why-us.create');
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
            'image' => 'required|image|max:2024'
        ]);

        validate_trans($request, [
            ['title', 'required'],
            ['text', 'required'],
        ]);
        $data = $request->except(['image']);
        if ($request->image != '') {
            $image = upload_image($request, 'image', 75, 75, 'settings');
            $data['image'] = $image;
        }
        $row = WhyChooseUs::create($data);

        return redirect()->to(route('why-us.index'))->with('success', getTranslatedWords('created successfully'));

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
        $row = WhyChooseUs::findOrFail($id);
        return view('dashboard.why-us.edit')->with(compact('row'));
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
            'image' => 'nullable|image|max:2024'
        ]);

        validate_trans($request, [
            ['title', 'required'],
            ['text', 'required'],
        ]);
        $data = $request->except(['image']);
        if ($request->image != '') {
            $image = upload_image($request, 'image', 75, 75, 'settings');
            $data['image'] = $image;
        }

        $row = WhyChooseUs::findOrFail($id);
        $row->update($data);

        return redirect()->to(route('why-us.index'))->with('success', getTranslatedWords('edited successfully'));
    }

    public function destroy($id)
    {
        $row = WhyChooseUs::findOrFail($id);
        $row->delete();
        return redirect()->to(route('why-us.index'))->with('success', getTranslatedWords('deleted successfully'));

    }
}
