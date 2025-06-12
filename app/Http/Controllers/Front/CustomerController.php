<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use App\Notifications\AdminNotification;
use Hash;
use Illuminate\Http\Request;
use Validator;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;

class CustomerController extends Controller
{
    public function __construct()
    {
        SEOMeta::setCanonical(url()->current());
        OpenGraph::setUrl(url()->current());
        JsonLd::addImage(route('file_show', [settings('logo'), 'settings']));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::twitter()->setSite(route('home'));
        SEOTools::jsonLd()->addImage(route('file_show', [settings('logo'), 'settings']));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $exist = \Cart::get($request->id);
        if ($exist != '') {
            if ($request->qty != '') {
                \Cart::update(
                    $request->id,
                    [
                        'quantity' => [
                            'relative' => false,
                            'value' => $request->qty,
                        ],
                    ]
                );
            } else {
                \Cart::update(
                    $request->id,
                    [
                        'quantity' => 1,

                    ]
                );
            }
            $items = \Cart::getcontent();
            $count = \Cart::getContent()->count();
            $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
            $view = view('front.components.cart_items', compact('items', 'count', 'total'))->render();
            return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);
        } else {
            $image = route('file_show', ['filename' => json_decode($product->images)[0], 'path' => 'products']);
            if ($request->qty != '') {
                \Cart::add([
                    'id' => $request->id,
                    'name' => $product->name,
                    'price' => $product->price,

                    'quantity' => $request->qty,
                    'attributes' => array(
                        'image' => $image,
                        'slug' => $product->slug,
                    ),
                ]);
            } else {
                \Cart::add([
                    'id' => $request->id,
                    'name' => $product->name,
                    'price' => $product->price,

                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $image,
                        'slug' => $product->slug
                    ),
                ]);
            }
            $items = \Cart::getcontent();

            $count = \Cart::getContent()->count();
            $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
            $view = view('front.components.cart_items', compact('items', 'count', 'total'))->render();
            return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('added successfully')]);
            //return response()->json(['status' => 'success', 'msg' => getTranslatedWords('added successfully')]);
        }

    }

    public function add_to_cart_product(Request $request)
    {
        $product = Product::find($request->product_id);
        $exist = \Cart::get($request->product_id);
        if ($exist != '') {
            if ($request->qty != '') {
                \Cart::update(
                    $request->product_id,
                    [
                        'quantity' => [
                            'relative' => false,
                            'value' => $request->qty,
                        ],
                    ]
                );
            } else {
                \Cart::update(
                    $request->product_id,
                    [
                        'quantity' => 1,

                    ]
                );
            }

            $items = \Cart::getcontent();
            $view = view('front.components.cart_items', compact('items'))->render();
            $count = \Cart::getContent()->count();
            $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
            return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);

            //return response()->json(['status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);
        } else {
            $image = route('file_show', ['filename' => $product->image, 'path' => 'products']);
            if ($request->qty != '') {
                \Cart::add([
                    'id' => $request->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->qty,
                    'attributes' => array(
                        'image' => $image,
                    ),
                ]);
            } else {
                \Cart::add([
                    'id' => $request->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $image,
                    ),
                ]);
            }

            $items = \Cart::getcontent();
            $view = view('front.components.cart_items', compact('items'))->render();
            $count = \Cart::getContent()->count();
            $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
            return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('added successfully')]);
            //return response()->json(['status' => 'success', 'msg' => getTranslatedWords('added successfully')]);
        }

    }

    public function addRemoveWishlist(Request $request)
    {

        $exist = auth()->guard('customer')->user()->favourites()->where('product_id', $request->id)->exists();
        if (!$exist) {
            auth()->guard('customer')->user()->favourites()->create([
                'product_id' => $request->id,
            ]);

            $count = auth()->guard('customer')->user()->favourites()->count();

            return response()->json(['count' => $count, 'status' => 'success', 'msg' => getTranslatedWords('added successfuly to your favourites')]);
            /*return response()->json(['status' => 'success', 'msg' => getTranslatedWords('added successfuly to your favourites')]);*/
        } else {
            auth()->guard('customer')->user()->favourites()->where(
                'product_id',
                $request->id
            )->delete();
            $count = auth()->guard('customer')->user()->favourites()->count();

            return response()->json(['count' => $count, 'status' => 'success', 'msg' => getTranslatedWords('deleted successfuly from your favourites'), 'remove' => true]);
            /*return response()->json(['status' => 'success', 'msg' => getTranslatedWords('deleted successfuly from your favourites')]);*/

        }
    }

    public function RemoveFromCart(Request $request)
    {
        if (\Cart::getContent()->count() == 1) {
            \Cart::clear();
        } else {
            \Cart::remove($request->id);
        }
        $items = \Cart::getcontent();
        $count = \Cart::getContent()->count();
        $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
        $view = view('front.components.cart_items', compact('items', 'total', 'count'))->render();

        return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('removed successfully')]);
        /*return response()->json(['status' => 'success', 'msg' => getTranslatedWords('removed successfully')]);*/

    }

    public function updateCart(Request $request)
    {
        $product = Product::find($request->id);
        if ($request->qty == '') {
            return response()->json(['status' => 'error', 'msg' => getTranslatedWords('fill quantity field')]);
        }
        if (!is_numeric($request->qty)) {
            return response()->json(['status' => 'error', 'msg' => getTranslatedWords('accept only numeric')]);
        } else {
            if ($request->qty < 0) {
                return response()->json(['status' => 'error', 'msg' => getTranslatedWords('accept only zero or more')]);
            } else {
                if ($request->qty == 0) {
                    \Cart::remove($request->id);
                } else {
                    $exist = \Cart::get($request->id);
                    if ($exist) {
                        \Cart::update(
                            $request->id,
                            [
                                'quantity' => [
                                    'relative' => false,
                                    'value' => $request->qty,
                                ],
                            ]
                        );
                    } else {
                        $image = route('file_show', ['filename' => json_decode($product->images)[0], 'path' => 'products']);
                        if ($request->qty != '') {
                            \Cart::add([
                                'id' => $request->id,
                                'name' => $product->name,
                                'price' => $product->price,
                                'quantity' => $request->qty,
                                'attributes' => array(
                                        'image' => $image,
                                    ),
                            ]);
                        } else {
                            \Cart::add([
                                'id' => $request->id,
                                'name' => $product->name,
                                'price' => $product->price,
                                'quantity' => 1,
                                'attributes' => array(
                                        'image' => $image,
                                    ),
                            ]);
                        }
                    }

                }

                $items = \Cart::getcontent();
                $count = \Cart::getContent()->count();
                $total = \Cart::getSubTotalWithoutConditions() . ' ' . getTranslatedWords('' . getTranslatedWords('L.E'));
                $view = view('front.components.cart_items', compact('items', 'total', 'count'))->render();
                if ($request->from_cart_page) {
                    if($request->qty!=0){
                        $product = \Cart::get($request->id);
                        return response()->json(['qty' => $product->quantity * $product->price . ' ' . getTranslatedWords('L.E'), 'total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);
                    }
                    return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);
                    
                } else {
                    return response()->json(['total' => $total, 'count' => $count, 'items' => $view, 'status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);
                }

                /*return response()->json(['status' => 'success', 'msg' => getTranslatedWords('edited successfully')]);*/
            }
        }

    }

    public function cart()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my cart'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my cart'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my cart'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my cart'));
        JsonLd::setDescription(settings('meta_description'));

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my cart'));
        return view('front.customer.cart');
    }

    public function whishlist()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('whishlist'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('whishlist'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('whishlist'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('whishlist'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('whishlist'));
        $favourites = auth()->guard('customer')->user()->favourites()->paginate(15);
        return view('front.customer.favourites', compact('favourites'));
    }

    public function profile()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer profile'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer profile'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer profile'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer profile'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer profile'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.customer.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable|numeric',
            'email' => 'required|email|unique:customers,email,' . auth()->guard('customer')->user()->id,
            'password' => 'nullable|min:6',
        ]);

        auth()->guard('customer')->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($request->password != '') {
            auth()->guard('customer')->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', getTranslatedWords('edited successfully'));
    }

    public function orders()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my orders'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my orders'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my orders'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my orders'));
        JsonLd::setDescription(settings('meta_description'));

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my orders'));
        $orders = auth()->guard('customer')->user()->orders()->latest()->paginate(15);
        return view('front.customer.orders', compact('orders'));
    }

    public function track($id)
    {
        $order = auth()->guard('customer')->user()->orders()->where('id', $id)->firstOrFail();
        return view('front.customer.track-order', compact('order'));
    }

    public function get_area_info(Request $request)
    {
        $area = Area::find($request->code);

        return response()->json(['text' => $area->shipping_fees . ' ' . getTranslatedWords('L.E'), 'value' => $area->shipping_fees]);
    }

    public function apply_coupon(Request $request)
    {
        if ($request->type == 'apply') {
            $coupon = Coupon::where('code', $request->code)->first();
            if ($coupon) {
                if ($coupon->is_ended()) {
                    return response()->json(
                        [
                            'status' => false,
                            'error' => getTranslatedWords('coupon expired'),
                        ]
                    );
                }

                if (auth()->guard('customer')->user()->orders()->where('coupon_id', $coupon->id)->count()) {
                    return response()->json(
                        [
                            'status' => false,
                            'error' => getTranslatedWords('coupon used before'),
                        ]
                    );
                }
                if (\Cart::isEmpty()) {
                    return response()->json(
                        [
                            'status' => false,
                            'error' => getTranslatedWords('cart is empty'),
                        ]
                    );
                }
                if ($coupon->discount_type == 'percentage') {
                    $total = \Cart::getSubTotalWithoutConditions() - (round(($coupon->discount_percentage * \Cart::getSubTotalWithoutConditions()) / 100));
                    $discount = round(($coupon->discount_percentage * \Cart::getSubTotalWithoutConditions()) / 100);
                } else {
                    $total = \Cart::getSubTotalWithoutConditions() - $coupon->discount_fixed_amount;
                    $discount = $coupon->discount_fixed_amount;
                }
                return response()->json([
                    'status' => true,
                    'discount' => $discount,
                    'total' => $total,
                    'coupon' => $coupon->id,
                ]);

            } else {
                return response()->json(
                    [
                        'status' => false,
                        'total'=>\Cart::getSubTotalWithoutConditions(),
                        'error' => getTranslatedWords('invalid coupon'),
                    ]
                );
            }
        }
        else {
            return response()->json(
                [
                    'status' => false,
                    'total'=>\Cart::getSubTotalWithoutConditions()
                ]
            );
        }

    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect()->to(route('home'))->with(['success' => getTranslatedWords('logged out successfuly')]);

    }

    public function send_rating(Request $request)
    {
        if ($request->ajax()) {

            $service = Product::find($request->product_id);
            $rating = ProductReview::where(['product_id' => $request->product_id, 'customer_id' => auth()->guard('customer')->user()->id])->get();
            if ($rating->count()) {
                $rating->first()->update([
                    'rate' => $request->rating,
                ]);

            } else {
                ProductReview::create([
                    'customer_id' => auth()->guard('customer')->user()->id,
                    'rate' => $request->rating,
                    'product_id' => $request->product_id,
                ]);
            }

            return response()->json(['msg' => getTranslatedWords('your rate registered successfuly')]);
        }
    }

    public function send_comment(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'review' => 'required',
                //'rating' => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json(
                    ['errors' => $validator->errors()->toArray()]

                );
            }
            $service = Product::find($request->product_id);
            $rating = ProductReview::where(['product_id' => $request->product_id, 'customer_id' => auth()->guard('customer')->user()->id])->get();
            if ($rating->count()) {
                $rating->first()->update([
                    'comment' => $request->review,
                    //'rate' => $request->rating,
                ]);

            } else {
                ProductReview::create([
                    'customer_id' => auth()->guard('customer')->user()->id,
                    'comment' => $request->review,
                    'product_id' => $request->product_id,
                    //'rate' => $request->rating
                ]);
            }

            return response()->json(['msg' => getTranslatedWords('your rate registered successfuly')]);
        }
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            //'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'coupon' => 'nullable|exists:coupons,id',
        ]);

        if ($validator->fails()) {

            return response()->json(
                ['errors' => $validator->errors()->toArray()]
            );
        }

        if ($request->coupon != '') {
            $coupon = $request->coupon;
            $co=Coupon::find($request->coupon);

            if ($co->discount_type == 'percentage') {
                $discount = round(($co->discount_percentage * \Cart::getSubTotalWithoutConditions()) / 100);
            } else {
                $discount = $co->discount_fixed_amount;
            }
        } else {
            $coupon = null;
            $discount=0;
        }

        


        $order = auth()->guard('customer')->user()->orders()->create([
            'status' => 'pending',
            //'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            //'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'payment_method' => 'cash_on_delivery',
            'is_paid'=>0,
            'coupon_id' => $coupon,
            'discount'=>$discount,
            'shipping_fees'=>Area::find($request->area_id)->shipping_fees
        ]);

        foreach (\Cart::getcontent() as $c) {

            $order->products()->create([
                'product_id' => $c->id,
                'qty' => $c->quantity,
            ]);
        }

        $order->update([
            'sub_total_price' => $order->products()->get()->sum(function ($q) {
                return $q->product->price * $q->qty;
            }),
        ]);

        if ($order->coupon_id != '') {
            $coupon = Coupon::find($order->coupon_id);
            if ($coupon->discount_type == 'percentage') {
                $total = $order->sub_total - (round(($coupon->discount_percentage * $order->sub_total) / 100));
            } else {
                $total = $order->sub_total - $coupon->discount_fixed_amount;
            }
        } else {
            $total = $order->sub_total;
        }

        $order->update([
            'total_price' => $total,
        ]);

        $order->trackings()->create([
            'status' => 'pending',
        ]);

        foreach (User::whereHas('roles', function ($q) {
            $q->whereHas('permissions', function ($q2) {
                $q2->where('name', 'list orders');
            });
        })->get() as $u
        ) {
            $message = [];
            foreach(getLanguages() as $l){
                $message[$l] = getTranslatedWordsTranslatedByCode('new order number', $l) . ' ' . $order->id;
            }
            
            $u->notify(new AdminNotification($message));

        }

        \Cart::clear();

        return response()->json(
            ['success' => getTranslatedWords('created successfully') . ' ' . getTranslatedWords('you can track order from orders page'), 'id' => $order->id]
        );
    }

    public function reviews()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my reviews'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my reviews'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my reviews'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my reviews'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my reviews'));
        $reviews = auth()->guard('customer')->user()->reviews()->latest()->paginate(15);
        return view('front.customer.reviews', compact('reviews'));
    }

    public function show_checkout(){
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('checkout'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('checkout'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('checkout'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('checkout'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('checkout'));
        if(!\Cart::getContent()->count()){
            return redirect()->to(route('cart'))->with('error', getTranslatedWords('cart is empty'));
        }
        return view('front.customer.checkout');
    }


    public function order_success($id)
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('order created successfuly'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('order created successfuly'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('order created successfuly'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('order created successfuly'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('order created successfuly'));
        
        $order = auth()->guard('customer')->user()->orders()->where('id', $id)->firstOrFail();
        return view('front.order_success', compact('order'));
    }
    public function customer_notifications()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my notifications'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my notifications'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my notifications'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my notifications'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('my notifications'));
        auth()->guard('customer')->user()->unreadNotifications->markAsRead();
        $notifications = auth()->guard('customer')->user()->notifications()->paginate(15);
        return view('front.customer.notifications', compact('notifications'));
    }

    

}
