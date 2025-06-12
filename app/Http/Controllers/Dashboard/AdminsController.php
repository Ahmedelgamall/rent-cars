<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('cando:list admins')->only(['index']);
        $this->middleware('cando:add admin')->only(['create','store']);
        $this->middleware('cando:edit admin')->only(['edit','update']);
        $this->middleware('cando:delete admin')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::all();
            return Datatables::of($query)
                ->editColumn('id', function ($query) {
                    return $query->id;
                })
                ->editColumn('name', function ($query) {
                    return $query->name;
                })

                ->editColumn('email', function ($query) {
                    return $query->email;
                })

                ->editColumn('roles', function ($query) {
                    if ($query->roles()->count()) {
                        $show = '<ul>';
                        foreach ($query->roles as $r) {
                            $show .= '<li>' . $r->name . '</li>';
                        }
                        $show .= '</ul>';
                        return $show;
                    }




                })


                ->addColumn('action', function ($query) {


                    if (auth()->user()->can('edit admin')) {
                        $edit = ' <a class="dropdown-item" href="' . route('admins.edit', $query->id) . '""
                        ><i class="bx bx-edit-alt me-1"></i>' . getTranslatedWords('edit') . '</a
                      >';
                    } else {
                        $edit = '';
                    }




                    if (auth()->user()->can('delete admin')) {
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
                })->rawColumns(['action', 'roles'])
                ->make(true);
        }

        return view('dashboard.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('dashboard.admins.create');
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3|confirmed',
            'roles' => 'required',
            'roles.*' => 'required|exists:roles,id'
        ]);
        $row = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $row->roles()->attach($request->roles);

        return redirect()->to(route('admins.index'))->with('success', getTranslatedWords('created successfully'));

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
        $row = User::findOrFail($id);
        return view('dashboard.admins.edit')->with(compact('row'));
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
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:3|confirmed',
            'roles' => 'required',
            'roles.*' => 'required|exists:roles,id'

        ]);

        $row = User::findOrFail($id);
        $row->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => empty($request->password) ? $row->password : Hash::make($request->password)
        ]);
        $row->roles()->sync($request->roles);
        

        return redirect()->to(route('admins.index'))->with('success', getTranslatedWords('edited successfully'));
    }

    public function destroy($id)
    {
        $row = User::findOrFail($id);
        if ($row->id == auth()->user()->id) {
            return redirect()->back()->with('error', getTranslatedWords('you can\'t delete yourself'));
        } else {

            $row->delete();
            return redirect()->to(route('admins.index'))->with('success', getTranslatedWords('deleted successfully'));

        }


    }
}