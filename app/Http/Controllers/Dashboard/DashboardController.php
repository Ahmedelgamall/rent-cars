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

        $years = [];
        foreach (Order::get() as $order) {

            if (!in_array(Carbon::parse($order->created_at)->year, $years)) {
                $years[] = Carbon::parse($order->created_at)->year;
            }

        }
        $orders_month = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(date('Y'), $month);
            $date_end = $date->copy()->endOfMonth();
            $orders_in_month = Order::where('created_at', '>=', $date)
                ->where('created_at', '<=', $date_end)->get();
            if (empty($orders_month[$month])) {
                $orders_month[$month] = 0;
            }
            foreach ($orders_in_month as $zm) {
                $orders_month[$month] += $zm->total_price;
            }
        }
        $fetch_orders = [];
        //$x = 0;
        foreach ($orders_month as $key => $v) {
            /*$fetch_orders[$x]['month'] = $key.'-'.Carbon::now()->year;
            $fetch_orders[$x]['count'] = $v;
            $x++;*/
            $fetch_orders[] = $v;
        }

        if (app()->getLocale() == 'ar') {
            $locale = 'ar_eg';
        } else {
            $locale = 'en_US';
        }
        //$human_readable = new \NumberFormatter($locale, \NumberFormatter::PADDING_POSITION);

        $cats = Category::take(6)->get();
        foreach ($cats as $category) {
            $categories[] = $category->name;
            $fetch_categories[] = OrderProduct::whereHas('product', function ($q) use ($category) {
                $q->whereJsonContains('categories', $category->id);
            })->count();
            $fetch_colors[] = $category->color;
        }

      
        return view('dashboard.dashboard', compact('fetch_orders', 'fetch_categories', 'categories', 'fetch_colors', 'years'));
    }

    public function change_year_profit_report(Request $request)
    {

        $orders_month = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create($request->data, $month);
            $date_end = $date->copy()->endOfMonth();
            $orders_in_month = Order::where('created_at', '>=', $date)
                ->where('created_at', '<=', $date_end)->get();
            if (empty($orders_month[$month])) {
                $orders_month[$month] = 0;
            }
            foreach ($orders_in_month as $zm) {
                $orders_month[$month] += $zm->total_price;
            }
        }
        $fetch_orders = [];
        //$x = 0;
        foreach ($orders_month as $key => $v) {
            /*$fetch_orders[$x]['month'] = $key.'-'.Carbon::now()->year;
            $fetch_orders[$x]['count'] = $v;
            $x++;*/
            $fetch_orders[] = $v;
        }

        if (app()->getLocale() == 'ar') {
            $locale = 'ar_eg';
        } else {
            $locale = 'en_US';
        }
        //$human_readable = new \NumberFormatter($locale, \NumberFormatter::PADDING_POSITION);



        $custom_fetch = [];

        foreach ($orders_month as $key => $v) {
            $custom_fetch[] = $v;
        }
        return response()->json($custom_fetch);
        //return $custom_fetch;
    }

    public function change_orders_stats_counter(Request $request)
    {

        if ($request->data == 'all') {
            return Order::count();
        }

        if ($request->data == 'day') {
            return Order::whereDate('created_at', Carbon::today())->count();
        }
        if ($request->data == 'week') {
            return Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        }
        if ($request->data == 'month') {
            return Order::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)->count();
        }
        if ($request->data == 'year') {
            return Order::whereYear('created_at', Carbon::now()->year)->count();
        }

    }

    public function change_profits_stats_counter(Request $request)
    {
        if ($request->data == 'day') {
            return Order::whereDate('created_at', Carbon::today())->sum('total') . ' ' . getTranslatedWords('' . settings('currency_code'));
        }
        if ($request->data == 'week') {
            return Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total') . ' ' . getTranslatedWords('' . settings('currency_code'));
        }
        if ($request->data == 'month') {
            return Order::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)->sum('total') . ' ' . getTranslatedWords('' . settings('currency_code'));
        }
        if ($request->data == 'year') {
            return Order::whereYear('created_at', Carbon::now()->year)->sum('total') . ' ' . getTranslatedWords('' . settings('currency_code'));
        }

    }

    public function change_customers_stats_counter(Request $request)
    {

        if ($request->data == 'all') {
            return Customer::count();
        }

        if ($request->data == 'day') {
            return Customer::whereDate('created_at', Carbon::today())->count();
        }
        if ($request->data == 'week') {
            return Customer::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        }
        if ($request->data == 'month') {
            return Customer::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)->count();
        }
        if ($request->data == 'year') {
            return Customer::whereYear('created_at', Carbon::now()->year)->count();
        }

    }




    public function change_categories_count(Request $request)
    {
        if (app()->getLocale() == 'ar') {
            $locale = 'ar_eg';
        } else {
            $locale = 'en_US';
        }
        //$human_readable = new \NumberFormatter($locale, \NumberFormatter::PADDING_POSITION);
        $data = [];


        if ($request->data == 'day') {
            $data['total'] = Order::whereDate('created_at', Carbon::today())->count();
            foreach (Category::take(6)->get() as $key => $category) {
                $data['fetch_categories'][] = OrderProduct::whereHas('product', function ($q) use ($category) {
                    $q->whereJsonContains('categories', $category->id);
                })->whereHas('order', function ($x) {
                    $x->whereDate('created_at', Carbon::today());
                })->count();
                $data['count'][] = OrderProduct::whereHas('product', function ($q) use ($category) {
                    $q->whereJsonContains('categories', $category->id);
                })->whereHas('order', function ($x) {
                    $x->whereDate('created_at', Carbon::today());
                })->count()
                ;
            }

        }
        if ($request->data == 'week') {
            $data['total'] = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            foreach (Category::take(6)->get() as $key => $category) {
                $data['fetch_categories'][] = OrderProduct::whereHas('product', function ($q) use ($category) {
                    $q->whereJsonContains('categories', $category->id);
                })->whereHas('order', function ($x) {
                    $x->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                })->count() ?? 0;
                $data['count'][] = 
                    OrderProduct::whereHas('product', function ($q) use ($category) {
                        $q->whereJsonContains('categories', $category->id);
                    })->whereHas('order', function ($x) {
                        $x->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    })->count()
                ;
            }

        }
        if ($request->data == 'month') {
            $data['total'] = Order::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)->count();
            foreach (Category::take(6)->get() as $key => $category) {
                $data['fetch_categories'][] = OrderProduct::whereHas('product', function ($q) use ($category) {
                    $q->whereJsonContains('categories', $category->id);
                })->whereHas('order', function ($x) {
                    $x->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month);
                })->count() ?? 0;
                $data['count'][] = 
                    OrderProduct::whereHas('product', function ($q) use ($category) {
                        $q->whereJsonContains('categories', $category->id);
                    })->whereHas('order', function ($x) {
                        $x->whereYear('created_at', Carbon::now()->year)
                            ->whereMonth('created_at', Carbon::now()->month);
                    })->count();
            }

        }
        if ($request->data == 'year') {
            $data['total'] = Order::whereYear('created_at', Carbon::now()->year)->count();
            foreach (Category::take(6)->get() as $key => $category) {
                $data['fetch_categories'][] = OrderProduct::whereHas('product', function ($q) use ($category) {
                    $q->whereJsonContains('categories', $category->id);
                })->whereHas('order', function ($x) {
                    $x->whereYear('created_at', Carbon::now()->year);
                })->count() ?? 0;
                $data['count'][] =
                    OrderProduct::whereHas('product', function ($q) use ($category) {
                        $q->whereJsonContains('categories', $category->id);
                    })->whereHas('order', function ($x) {
                        $x->whereYear('created_at', Carbon::now()->year);
                    })->count();
            }

        }

        foreach (Category::take(6)->get() as $key => $category) {
            $data['categories'][] = $category->name;
            /*$data['fetch_categories'][]=OrderProduct::whereHas('product',function($q) use ($category){
                $q->where('category_id',$category->id);
            })->count();*/
            $data['fetch_colors'][] = $category->color;
        }
        $view = view('dashboard.categories_products_count', compact('data'))->render();
        return response()->json(['success' => $view, 'data' => $data]);


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
