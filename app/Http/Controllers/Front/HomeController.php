<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Hash;
use Illuminate\Http\Request;
use Validator;
use App\Models\Contact;
use Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\CarOrder;
use App\Models\User;

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



    public function cars(Request $request)
    {
        //\Cart::clear();
        SEOMeta::setTitle(settings('system_name') . ' - ' . getTranslatedWords('cars'));
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . getTranslatedWords('cars'));

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . getTranslatedWords('cars'));


        JsonLd::setTitle(settings('system_name') . ' - ' . getTranslatedWords('cars'));
        JsonLd::setDescription(settings('meta_description'));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . getTranslatedWords('cars'));
        SEOTools::setDescription(settings('meta_description'));
        if($request->category_id!=''){
            $cars = Car::where('category_id',$request->category_id)->latest()->paginate(15);
        }
        else {
            $cars = Car::latest()->paginate(15);
        }

        foreach(Car::get() as $c){
            $c->update([
                'slug:ar'=>Str::slug($c->title)
            ]);
        }
        
    
        return view('front.cars', compact('cars'));
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
        $cars = car::query();
        $cars->whereNotNull('price_before')->where('is_available',1);
        if ($request->search != '') {
            $cars->where(function ($q) use ($request) {
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
                $cars->orderByTranslation('name');
            } elseif ($request->sort == 'price_low_high') {
                $cars->orderBy('price');
            } elseif ($request->sort == 'price_high_low') {
                $cars->orderBy('price', 'desc');
            }
        }

        if($request->has('categories')){
            $cars->whereJsonContains('categories',$request->categories);
        }
       
        $cars=$cars->latest()->paginate(15);
        return view('front.offers', compact('cars'));
    }


    public function info($slug)
    {
        $car = Car::whereTranslation('slug', $slug)->firstOrFail();
        SEOMeta::setTitle(settings('system_name') . ' - ' . $car->title);
        SEOMeta::setDescription(settings('meta_description'));

        OpenGraph::setTitle(settings('system_name') . ' - ' . $car->title);

        //OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(settings('system_name') . ' - ' . $car->title);


        JsonLd::setTitle(settings('system_name') . ' - ' . $car->title);
        JsonLd::setDescription(Str::words($car->description, 50));


        // OR

        SEOTools::setTitle(settings('system_name') . ' - ' . $car->title);
        SEOTools::setDescription(Str::words($car->description, 50));
        $related=Car::where('category_id',$car->category_id)->where('id','!=',$car->id)->take(15)->get();
        return view('front.car', compact('car','related'));
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

        /*foreach (User::whereHas('roles', function ($q) {
            $q->whereHas('permissions', function ($q2) {
                $q2->where('name', 'list contacts');
            });
        })->get() as $u) {
            $message = [];
            foreach(getLanguages() as $l){
                $message[$l] = getTranslatedWordsTranslatedByCode('new contact message number', $l) . ' ' . $row->id;
            }
            $u->notify(new AdminNotification($message));
        }*/

        return redirect()->back()->with(['success' => getTranslatedWords('your message sent successfuly we will be in contact with you as soon as possible')]);

    }


    public function order(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required'
        ]);

        $row = CarOrder::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'car_id'=>$request->car_id
        ]);

        /*foreach (User::whereHas('roles', function ($q) {
            $q->whereHas('permissions', function ($q2) {
                $q2->where('name', 'list orders');
            });
        })->get() as $u) {
            $message = [];
            foreach(getLanguages() as $l){
                $message[$l] = getTranslatedWordsTranslatedByCode('new car order number', $l) . ' ' . $row->id;
            }
            $u->notify(new AdminNotification($message));
        }*/

        return redirect()->back()->with(['success' => getTranslatedWords('your message sent successfuly we will be in contact with you as soon as possible')]);

    }
    

    

}
