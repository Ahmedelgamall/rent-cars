<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('cando:list roles')->only('index');
        $this->middleware('cando:add role')->only(['store']);
        $this->middleware('cando:edit role')->only(['update']);
        $this->middleware('cando:delete role')->only('destroy');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = config('permission.models.role')::all();
            return Datatables::of($query)
                ->editColumn('id', function ($query) {
                    return $query->id;
                })
                ->editColumn('name', function ($query) {
                    return $query->name;
                })

                ->addColumn('action', function ($query) {

                    if (auth()->user()->can('edit role')) {
                        $edit = ' <a class="dropdown-item" href="' . route('roles.edit', $query->id) . '""
                        ><i class="bx bx-edit-alt me-1"></i>' . getTranslatedWords('edit') . '</a
                      >';
                    } else {
                        $edit = '';
                    }

                  

                    if (auth()->user()->can('delete role')) {
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
        return view('dashboard.roles.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.roles.create');
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
            'permissions.*' => 'required|exists:permissions,id',
        ]);
        
        $row = config('permission.models.role')::create(['name' => $request->name]);
        $row->permissions()->sync($request->permissions);
        return redirect()->to(route('roles.index'))->with('success', getTranslatedWords('created successfully'));
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
        $row = config('permission.models.role')::findOrFail($id);
        return view('dashboard.roles.edit')->with(compact('row'));
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
            'name' => [
                'required',
                'string',
                ['max' => 255],
                Rule::unique('roles')->where(function ($query) use ($id, $request) {

                    return $query
                        ->where('name', $request->name)
                        ->where('guard_name', 'web')
                        ->whereNotIn('id', [$id]);
                }),
            ],
            'permissions' => 'required',
            'permissions.*' => 'required|exists:permissions,id',
        ]);

        $row = config('permission.models.role')::findOrFail($id);
        $row->update([
            'name' => $request->name,
        ]);
        $row->permissions()->sync($request->permissions);
        return redirect()->to(route('roles.index'))->with('success', getTranslatedWords('edited successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $row = config('permission.models.role')::findOrFail($id);
            if ($row->name == 'super admin') {
                return redirect()->back()->with('error', getTranslatedWords('you can\'t delete this role'));
            }
            $row->delete();
            return redirect()->to(route('roles.index'))->with('success', getTranslatedWords('deleted successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function get_permissions(Request $request)
    {

        $per = [];
        /*$permissions = config('permission.models.permission')
        ::where("guard_name", $request->type == 'admin' ? 'web' : 'employee')
        ->pluck("name", "id");

        foreach ($permissions as $key => $p) {
        $per[$key] = getTranslatedWords('' . $p);
        }

        return response()->json($per);*/
        $groups = [];
        // $categories = [];
        if ($request->groups != '') {
            $groups = $request->groups;
        }
        /*if ($request->categories != '') {
        $categories = $request->categories;
        }*/

        foreach ($groups as $key => $val) {
            $monitors = $permissions = config('permission.models.permission')
                ::where("guard_name", 'web')
                ->where('permission_group', $val)
                //->where('permission_category', $categories[$key])
                ->groupBy('permission_monitor')
                ->pluck('permission_monitor');
            $permissions = config('permission.models.permission')
                ::where("guard_name", 'web')
                ->where('permission_group', $val)
                //->where('permission_category', $categories[$key])
                ->pluck("name", "id");
            foreach ($permissions as $key => $p) {
                $per['permissions'][$key] = getTranslatedWords('' . $p);
            }

            foreach ($monitors as $key => $p) {
                $key = $p;
                $per['monitors'][$key] = getTranslatedWords('' . $p);
            }

        }

        //dd($per);

        /*$permissions = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('permission_group',$request->groups)
        ->whereIn('permission_category',$request->categories)
        ->pluck("name", "id");*/

        /*foreach ($permissions as $key => $p) {
        $per[$key] = getTranslatedWords('' . $p);
        }*/

        return response()->json($per);

    }

    public function show_permissions(Request $request)
    {

        $data = [];
        $ids = [];
        if ($request->ids != '') {
            $ids = $request->ids;
        }
        $groups = config('permission.models.permission')
            ::where("guard_name", 'web')
            ->whereIn('id', $ids)
            ->groupBy('permission_group')
            ->pluck('permission_group');
        foreach ($groups as $g) {
            $permissions = config('permission.models.permission')
                ::where("guard_name", 'web')
                ->whereIn('id', $ids)
                ->where('permission_group', $g)
                ->pluck("name", "id");
            foreach ($permissions as $key => $p) {
                //$key=$p;
                //$per[$g][$key]=$p;
                $data[$g][$key] = getTranslatedWords('' . $p);
            }
        }

        /* dd($ids);
        $groups = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('id', $ids)
        ->groupBy('permission_group')
        ->pluck('permission_group');

        dd($groups);

        $permissions = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('id', $ids)
        ->pluck("name", "id");
        foreach($groups as $g){
        foreach ($permissions as $key => $p) {
        $key=$p;
        $per[$g][$key]=$p;
        $per[$g][$key] = getTranslatedWords('' . $p);
        }

        }

        dd($per);

        foreach ($permissions as $key => $p) {

        }*/

        /*$permissions = config('permission.models.permission')
        ::where("guard_name", $request->type == 'admin' ? 'web' : 'employee')
        ->pluck("name", "id");
        $per = [];
        foreach ($permissions as $key => $p) {
        $per[$key] = getTranslatedWords('' . $p);
        }

        return response()->json($per);*/

        /* $permissions = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('id',$ids)
        ->orderBy('permission_group')
        ->orderBy('permission_category')
        ->get();
        dd($permissions);*/

        /*$permissions = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('id', $ids)
        ->pluck("name", "id");

        foreach ($permissions as $key => $p) {
        $per[$key] = getTranslatedWords('' . $p);
        }*/

        $view = view('dashboard.roles.show_permissions', compact('data'))->render();
        return response()->json([$view]);
        //return response()->json($per);

    }

    public function get_permissions_per_monitor(Request $request)
    {

        $per = [];
        /*$permissions = config('permission.models.permission')
        ::where("guard_name", $request->type == 'admin' ? 'web' : 'employee')
        ->pluck("name", "id");
        $per = [];
        foreach ($permissions as $key => $p) {
        $per[$key] = getTranslatedWords('' . $p);
        }

        return response()->json($per);*/

        /* $permissions = config('permission.models.permission')
        ::where("guard_name", 'web')
        ->whereIn('id',$ids)
        ->orderBy('permission_group')
        ->orderBy('permission_category')
        ->get();
        dd($permissions);*/

        $permissions = config('permission.models.permission')
            ::where("guard_name", 'web')
            ->where('permission_monitor', $request->monitor)
            ->pluck("name", "id");

        foreach ($permissions as $key => $p) {
            $per[$key] = getTranslatedWords('' . $p);
        }

        return response()->json($per);

    }

}