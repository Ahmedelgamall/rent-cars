<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Category;
use App\Models\Customer;
use Intervention\Image\ImageManagerStatic as Image;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|min:3'
        ]);
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => !empty($request->password) ? Hash::make($request->password) : auth()->user()->password,
            'profile_image' => !empty($request->image) ? upload_image($request, 'image', 160, 160, 'settings') : auth()->user()->profile_image
        ]);
        return redirect()->to(route('profile'))->with('success', 'تم التعديل بنجاح');
    }

    public function myNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->notifications()->paginate(15);
        return view('dashboard.notifications')->with(compact('notifications'));
    }

    public function markReadNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => getTranslatedWords('edited successfully')]);
    }
}
