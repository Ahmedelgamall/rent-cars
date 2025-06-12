<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;


class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('cando:list contacts')->only(['index']);
        $this->middleware('cando:delete contact')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Contact::all();
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

                ->editColumn('phone', function ($query) {
                    return $query->phone;
                })


                ->editColumn('message', function ($query) {
                    $message = '<button data-msg="' . $query->message . '" class="btn btn-sm btn-primary message"><i class="bx bx-show"></i></button>';
                    return $message;
                })

                ->editColumn('sent date', function ($query) {
                    return $query->created_at->diffForHumans();
                })



                ->addColumn('action', function ($query) {


                    if (auth()->user()->can('delete contact')) {
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
                    <div class="dropdown-menu">' . $delete . '</div></div>';




                    return $actioinView;
                })->rawColumns(['action', 'message'])
                ->make(true);
        }

        return view('dashboard.contacts.index');
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

    }

    public function destroy($id)
    {
        $row = Contact::findOrFail($id);
        $row->delete();

        return redirect()->to(route('contacts.index'))->with('success', getTranslatedWords('deleted successfully'));


    }
}