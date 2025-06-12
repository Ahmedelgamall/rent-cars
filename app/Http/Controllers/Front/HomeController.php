<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Product;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\Contact;
use Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use App\Models\Area;


//use Socialite;



class HomeController extends Controller
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
    public function home()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('home'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('home'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('home'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('home'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('home'));
        SEOTools::setDescription(settings('meta_description'));

        return view('front.home');
    }

    public function about()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('about us'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('about us'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('about us'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('about us'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('about us'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.about');
    }



    public function shop(Request $request)
    {
        //\Cart::clear();
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('shop'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('shop'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('shop'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('shop'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('shop'));
        SEOTools::setDescription(settings('meta_description'));
        $products = Product::query();
        $products->whereNull('price_before')->where('is_available',1);
        if ($request->search != '') {
            $products->where(function ($q) use ($request) {
                $q->whereHas('translations', function ($x) use ($request) {
                    $x->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('details', 'like', '%' . $request->search . '%');
                });
            })->orWhereHas('tags', function ($u) use ($request) {
                $u->where('tag', 'like', '%' . $request->search . '%')
                    ->where('locale', app()->getLocale());
            });
        }
        if ($request->has('sort')) {
            if ($request->sort == 'name') {
                $products->orderByTranslation('name');
            } elseif ($request->sort == 'price_low_high') {
                $products->orderBy('price');
            } elseif ($request->sort == 'price_high_low') {
                $products->orderBy('price', 'desc');
            }
        }

        if($request->has('categories')){
            $products->whereJsonContains('categories',$request->categories);
        }
       
        $products=$products->latest()->paginate(15);
        return view('front.shop', compact('products'));
    }


    public function offers(Request $request)
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('offers'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('offers'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('offers'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('offers'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('offers'));
        SEOTools::setDescription(settings('meta_description'));
        $products = Product::query();
        $products->whereNotNull('price_before')->where('is_available',1);
        if ($request->search != '') {
            $products->where(function ($q) use ($request) {
                $q->whereHas('translations', function ($x) use ($request) {
                    $x->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('details', 'like', '%' . $request->search . '%');
                });
            })->orWhereHas('tags', function ($u) use ($request) {
                $u->where('tag', 'like', '%' . $request->search . '%')
                    ->where('locale', app()->getLocale());
            });
        }
        if ($request->has('sort')) {
            if ($request->sort == 'name') {
                $products->orderByTranslation('name');
            } elseif ($request->sort == 'price_low_high') {
                $products->orderBy('price');
            } elseif ($request->sort == 'price_high_low') {
                $products->orderBy('price', 'desc');
            }
        }

        if($request->has('categories')){
            $products->whereJsonContains('categories',$request->categories);
        }
       
        $products=$products->latest()->paginate(15);
        return view('front.offers', compact('products'));
    }


    public function product($slug)
    {
        $product = Product::whereTranslation('slug', $slug)->firstOrFail();
        SEOMeta::setTitle(settings('system_name') . ' - ' . $product->name);
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . $product->name);

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . $product->name);


        JsonLd::setTitle(settings('system_name') . ' - ' . $product->name);
        JsonLd::setDescription(Str::words($product->details, 50));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . $product->name);
        SEOTools::setDescription(Str::words($product->details, 50));
        $related=Product::whereJsonContains('categories',json_decode($product->categories))->where('id','!=',$product->id)->take(15)->get();
        return view('front.product', compact('product','related'));
    }



    public function blog()
    {
        $posts = Blog::latest()->paginate(15);
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('blog'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('blog'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('blog'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('blog'));
        JsonLd::setDescription(settings('system_name') . ' ' . getTranslatedWords('blog'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('blog'));
        SEOTools::setDescription(settings('system_name') . ' ' . getTranslatedWords('blog'));
        return view('front.posts', compact('posts'));
    }

    public function blog_details($slug)
    {
        $post = Blog::whereTranslation('slug', $slug)->firstOrFail();
        SEOMeta::setTitle(settings('system_name') . ' - ' . $post->title);
        SEOMeta::setDescription($post->meta_description);
        SEOMeta::addMeta('keywords', $post->meta_keywords);

        OpenGraph::setTitle(settings('system_name') . ' - ' . $post->title);

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . $post->title);


        JsonLd::setTitle(settings('system_name') . ' - ' . $post->title);
        JsonLd::setDescription($post->meta_description);


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . $post->title);
        SEOTools::setDescription($post->meta_description);
        return view('front.post', compact('post'));
    }



    public function contact()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('contact us'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('contact us'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('contact us'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('contact us'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('contact us'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.contact');
    }

    public function send_contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required'
        ]);

        $row = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);

        foreach (User::whereHas('roles', function ($q) {
            $q->whereHas('permissions', function ($q2) {
                $q2->where('name', 'list contacts');
            });
        })->get() as $u) {
            $message = [];
            foreach(getLanguages() as $l){
                $message[$l] = getTranslatedWordsTranslatedByCode('new contact message number', $l) . ' ' . $row->id;
            }
            $u->notify(new AdminNotification($message));
        }

        return redirect()->back()->with(['success' => getTranslatedWords('your message sent successfuly we will be in contact with you as soon as possible')]);

    }


    public function login(){
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer login'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer login'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer login'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer login'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer login'));
        SEOTools::setDescription(settings('meta_description'));

        return view('front.login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required',
        ]);
        if (auth()->guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $customer = auth()->guard('customer')->user();
            if ($customer->activated == 0) {
                auth()->guard('customer')->logout();
                return redirect()->back()->with(['error' => getTranslatedWords('account is not activated')]);
            }
            if (request()->get('url')) {
                return redirect()->to(urldecode(request()->get('url')))->with(['success' => getTranslatedWords('login success')]);
            }

            return redirect()->to(route('home'))->with(['success' => getTranslatedWords('login success')]);

        } else {
            return redirect()->back()->with(['error' => getTranslatedWords('These credentials do not match our records')]);
        }
    }

    public function register(){
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer register'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer register'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer register'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer register'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer register'));
        SEOTools::setDescription(settings('meta_description'));

        return view('front.register');
    }


    public function registerPost(Request $request){

        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed|min:6',
            'name' => 'required',
        ]);
        $token = Str::random(30);
        
        $customer = Customer::create([
            'email' => $request->email,
            'name' => $request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'password' => Hash::make($request->password),
            'verified_token' => $token,
        ]);
        try {
                  
            Mail::send('emails.activation',
            array(
                'name' => $customer->name,
                'token'=>$token
                
            ), function($message) use ($customer)
        {
            
            $message->to($customer->email)->subject(getTranslatedWords('activation account in').' '.settings('system_name'));
            
            $message->from(settings('email'),settings('system_name'));
        });
        
       
            return redirect()->back()->with(['success'=>getTranslatedWords('your account is created successfuly you will receive an email to activate your account')]);
        
        }
        
        catch(Exception $e) {
            return redirect()->back()->with(['error'=>customer('Error in posting, try again later')]);
           
        }
  

    }

    public function activateAccount($token)
    {
        $customer = Customer::where('verified_token', $token)->first();
        if ($customer) {
            if ($customer->activated == 1) {
                return redirect()->to(route('home'))->with(['error'=>getTranslatedWords('You already Activate Your Account Before Login To It')]);
                

            } else {
                $customer->update([
            'activated'=>1
        ]);
        if(request()->get('url')){
            return redirect()->to(urldecode(request()->get('url')))->with(['success'=>getTranslatedWords('Your account activated successfuly')]);
        }
                 return redirect()->to(route('home'))->with(['success'=>getTranslatedWords('Your account activated successfuly')]);
               
                
              


            }
        } else {
            return redirect()->to(route('home'))->with(['error'=>getTranslatedWords('You Use Wrong Link To Activate Account')]);
            
        }
        
    }

    public function forgetPassword()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer forget password'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer forget password'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer forget password'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer forget password'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer forget password'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.reset-password');
    }
    
    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:customers,email'
        ]);
        
        $customer=Customer::where('email',$request->email)->first();
        
        $token = Str::random(30);
            $customer->update([
                'reset_token'=>$token
            ]);
            try {
                 
                  Mail::send('emails.reset',
                  request()->get('url') ? array(
                      'name' => $customer->name,
                      'token'=>$token,
                      'url'=>request()->get('url')
                  ) :
                  array(
                      'name' => $customer->name,
                      'token'=>$token
                      
                  ), function($message) use ($customer)
              {
                  
                  $message->to($customer->email)->subject(getTranslatedWords('reset password in').' '.settings('system_name'));
                  
                  $message->from(settings('email'),settings('system_name'));
              });
              
             
                  return redirect()->back()->with(['success'=>getTranslatedWords('check your email to reset your password')]);
              
              }
              
              catch(Exception $e) {
                  return redirect()->back()->with(['error'=>getTranslatedWords('Error in posting, try again later')]);
                 
              }
        
    }


    public function resetPassword($token)
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer reset password'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer reset password'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer reset password'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer reset password'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('customer reset password'));
        SEOTools::setDescription(settings('meta_description'));
        $customer = Customer::where('reset_token', $token)->first();
        if ($customer) {
            
              
            return view('front.new-password');
            
        } else {
            return redirect()->to(route('home'))->with(['error'=>getTranslatedWords('You Use Wrong Link To reset password')]);
            
        }
        
    }
    
    public function resetPasswordPost(Request $request,$token){
        $request->validate([
            //'email'=>'required',
            'password'=>'required|confirmed'    
        ]);
        
        $customer = Customer::where('reset_token',$token)->first();
        
        if($customer){
            $customer->update([
                'password'=>Hash::make($request->password),
                'activated'=>1,
                'reset_token'=>null
            ]);
            return redirect()->to(route('customer-login'))->with(['success'=>getTranslatedWords('password reset successfuly login now')]);
        }
        
        else {
            return redirect()->to(route('home'))->with(['error'=>getTranslatedWords('wrong email')]);
        }
    }

    public function terms()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('terms and conditions'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('terms and conditions'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('terms and conditions'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('terms and conditions'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('terms and conditions'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.terms');
    }

    public function privacy()
    {
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('privacy policy'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('privacy policy'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('privacy policy'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('privacy policy'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('privacy policy'));
        SEOTools::setDescription(settings('meta_description'));
        return view('front.privacy');
    }
    
    public function get_areas(Request $request)
    {
        $areas = Area::where('city_id', $request->code)->get();
        return response()->json([
            'success' => $areas
        ]);
    }

}
