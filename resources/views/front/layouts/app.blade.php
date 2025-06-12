<!doctype html>
<html class="no-js" lang="app()->getLocale()" dir="@if (app()->getLocale() == 'ar')
rtl
@else
ltr
@endif">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ route('file_show', [settings('logo'), 'settings']) }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/responsive.css') }}">
    <style>
        .w-10 {
            max-width: 15%;
        }

        .ltn__top-bar-menu>ul>li>i,
        .ltn__top-bar-menu>ul>li>a>i {
            display: inline-block;
        }

        input[type="tel"] {
            background-color: var(--white);
            border: 2px solid;
            border-color: var(--border-color-9);
            height: 65px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-right: 20px;
            font-size: 16px;
            color: var(--ltn__paragraph-color);
            width: 100%;
            margin-bottom: 30px;
            border-radius: 0;
            padding-left: 40px;
            text-align: right
        }

        .mini-user-icon {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            line-height: 30px;
            cursor: pointer;
            color: var(--ltn__heading-color);
        }


        .mini-user-icon sup {
            font-size: 12px;
            font-weight: 600;
            height: 20px;
            width: 20px;
            line-height: 20px;
            background-color: var(--ltn__secondary-color);
            color: var(--white);
            text-align: center;
            border-radius: 100%;
            left: 8px;
            top: -8px;
        }
    </style>
    @if (App::getLocale() == 'ar')
        <link href="{{ asset('assets/tajawal.css') }}" rel="stylesheet" />
        <style>
            :root {

                --ltn__heading-font: 'tajawal', 'sans serif';
                --ltn__body-font: 'tajawal', 'sans serif';

            }

            body {
                font-family: 'tajawal', 'sans serif'
            }

            .mini-cart-quantity {
                direction: ltr;
                display: inline-block
            }

            input[type="password"] {
                letter-spacing: 0px;
            }

            .nice-select {
                float: right;
                text-align: right !important;
            }

            .nice-select .option {
                text-align: right !important;
            }
        </style>
    @endif
    @yield('css')
</head>
<div class="body-wrapper">

    <!-- HEADER AREA START (header-3) -->
    <header class="ltn__header-area ltn__header-3 section-bg-6---">
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area border-bottom top-area-color-white---">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li><a href="mailto:{{ settings('email') }}"><i class="icon-mail"></i>{{ settings('email') }}</a></li>
                                <li><a href=""><i class="icon-placeholder"></i>
                                        {{ settings(attr: 'address') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="top-bar-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li>
                                        <!-- ltn__language-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                            <ul>
                                                <li><a href="#" class="dropdown-toggle"><span class="active-currency">
                                                            @if (app()->getLocale() == 'ar')
                                                                العربية
                                                            @else
                                                                English
                                                            @endif
                                                        </span></a>
                                                    <ul>
                                                        @foreach (getLanguages() as $lang)
                                                            <li><a href="{{ LaravelLocalization::getLocalizedURL($lang, null, [], true) }}">
                                                                    @if ($lang == 'ar')
                                                                        العربية
                                                                    @else
                                                                        English
                                                                    @endif
                                                                </a></li>
                                                        @endforeach


                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- ltn__social-media -->
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li><a href="{{ settings('facebook_link') }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="{{ settings('twitter_link') }}" title="Twitter"><i class="fab fa-twitter"></i></a>
                                                </li>

                                                <li><a href="settings('instagram_link')" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-top-area end -->
        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo">
                            <a href="{{ route('home') }}"><img
                                    src="{{ route('file_show', [settings('logo'), 'settings']) }}" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col header-contact-serarch-column d-none d-xl-block">
                        <div class="header-contact-search">
                            <!-- header-feature-item -->
                            <div class="header-feature-item d-none">
                                <div class="header-feature-icon">
                                    <i class="icon-phone"></i>
                                </div>
                                <div class="header-feature-info">
                                    <h6>{{ getTranslatedWords('phone') }}</h6>
                                    <p><a href="tel:{{ settings('phone') }}">{{ settings('phone') }}</a></p>
                                </div>
                            </div>
                            <!-- header-search-2 -->
                            <div class="header-search-2">
                                <form id="#123" method="get" action="{{ route('shop') }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ getTranslatedWords('search') }}" />
                                    @foreach (request()->except(['search']) as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    <button type="submit">
                                        <span><i class="icon-search"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- header-options -->
                        <div class="ltn__header-options">
                            <ul>

                                <li class="d-none--- ">
                                    <!-- header-search-1 -->
                                    <div class="header-search-wrap d-block d-xl-none">
                                        <div class="header-search-1">
                                            <div class="search-icon">
                                                <i class="icon-search  for-search-show"></i>
                                                <i class="icon-cancel  for-search-close"></i>
                                            </div>
                                        </div>
                                        <div class="header-search-1-form">
                                            <form id="#" method="get" action="{{ route('shop') }}">
                                                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ getTranslatedWords('search') }}" />
                                                @foreach (request()->except(['search']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                                @endforeach
                                                <button type="submit">
                                                    <span><i class="icon-search"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-none---">
                                    <!-- user-menu -->
                                    <div class="ltn__drop-menu user-menu">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <span class="mini-user-icon">
                                                        <i class="icon-user"></i>
                                                        @if (auth()->guard('customer')->check() && auth()->guard('customer')->user()->unreadNotifications()->count())
                                                            <sup class="notifications_count">{{ auth()->guard('customer')->user()->unreadNotifications()->count() }}</sup>
                                                        @endif
                                                    </span>
                                                </a>
                                                <ul>
                                                    @if (!auth()->guard('customer')->check())
                                                        <li><a href="{{ route('customer-login') }}">{{ getTranslatedWords('login') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('register-customer') }}">{{ getTranslatedWords('register') }}</a>
                                                        </li>
                                                    @else
                                                        <li><a href="{{ route('customer-profile') }}">{{ getTranslatedWords('profile') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('whishlist') }}">{{ getTranslatedWords('whishlist') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('customer-notifications') }}">{{ getTranslatedWords('notifications') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('customer-orders') }}">{{ getTranslatedWords('orders') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('customer-reviews') }}">{{ getTranslatedWords('reviews') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('customer-logout') }}">{{ getTranslatedWords('logout') }}</a>
                                                        </li>
                                                    @endif


                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <!-- mini-cart 2 -->
                                    <div class="mini-cart-icon mini-cart-icon-2">
                                        <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                            <span class="mini-cart-icon">
                                                <i class="icon-shopping-cart"></i>
                                                <sup>{{ \Cart::getContent()->count() }}</sup>
                                            </span>
                                            <h6><span>{{ getTranslatedWords('cart') }}</span> <span class="ltn__secondary-color">{{ \Cart::getSubTotalWithoutConditions() }}
                                                    {{ getTranslatedWords('L.E') }}</span>
                                            </h6>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-middle-area end -->

        <!-- MOBILE MENU START -->
        <div class="mobile-header-menu-fullwidth mb-20 d-block d-lg-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-lg-none">
                            <span>{{ getTranslatedWords('menu') }}</span>
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MOBILE MENU END -->

        <!-- header-bottom-area start -->
        <div class="header-bottom-area ltn__border-top--- ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg---- menu-color-white---- d-none--- d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 align-self-center">
                        <!-- CATEGORY-MENU-LIST START -->
                        <div class="ltn__category-menu-wrap ltn__category-dropdown-hide ltn__category-menu-with-header-menu">
                            <div class="ltn__category-menu-title">
                                <h2 class="section-bg-1--- ltn__secondary-bg text-color-white">
                                    {{ getTranslatedWords('categories') }}</h2>
                            </div>
                            <div class="ltn__category-menu-toggle ltn__one-line-active">
                                <ul>
                                    <!-- Submenu Column - unlimited -->

                                    <!-- Submenu Column - 2 -->
                                    @foreach (App\Models\Category::whereNull('parent_id')->take(10)->get() as $main_cat)
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="{{ route('shop', ['categories' => $main_cat->id]) }}">
                                                <img class="img-fluid w-10" src="{{ route('file_show', [$main_cat->image, 'categories']) }}" alt="">
                                                {{ $main_cat->name }}</a>
                                            @if (App\Models\Category::where('parent_id', $main_cat->id)->count())
                                                <ul class="ltn__category-submenu ltn__category-column-2">
                                                    @foreach (App\Models\Category::where('parent_id', $main_cat->id)->get() as $sub_cat)
                                                        <li class="ltn__category-submenu-title ltn__category-menu-drop">
                                                            <a href="{{ route('shop', ['categories' => $sub_cat->id]) }}">{{ $sub_cat->name }}</a>
                                                            @if (App\Models\Category::where('parent_id', $sub_cat->id)->count())
                                                                <ul class="ltn__category-submenu-children">
                                                                    @foreach (App\Models\Category::where('parent_id', $sub_cat->id)->get() as $sub_sub_cat)
                                                                        <li><a href="{{ route('shop', ['categories' => $sub_sub_cat->id]) }}">{{ $sub_sub_cat->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                    @endforeach

                                    @foreach (App\Models\Category::whereNull('parent_id')->orderBy('id')->skip(10)->take(1000)->get() as $other_cat)
                                        <li class="ltn__category-menu-more-item-child">
                                            <a href="{{ route('shop', ['categories' => $other_cat->id]) }}"> <img class="img-fluid w-10" src="{{ route('file_show', [$other_cat->image, 'categories']) }}" alt="">{{ $other_cat->name }}</a>
                                            @if (App\Models\Category::where('parent_id', $other_cat->id)->count())
                                                <ul class="ltn__category-submenu ltn__category-column-2">
                                                    @foreach (App\Models\Category::where('parent_id', $other_cat->id)->get() as $sub_other_cat)
                                                        <li class="ltn__category-submenu-title ltn__category-menu-drop">
                                                            <a href="{{ route('shop', ['categories' => $sub_other_cat->id]) }}">{{ $sub_other_cat->name }}</a>
                                                            @if (App\Models\Category::where('parent_id', $sub_other_cat->id)->count())
                                                                <ul class="ltn__category-submenu-children">
                                                                    @foreach (App\Models\Category::where('parent_id', $sub_other_cat->id)->get() as $sub_sub_other_cat)
                                                                        <li><a href="{{ route('shop', ['categories' => $sub_sub_other_cat->id]) }}">{{ $sub_sub_other_cat->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                    @endforeach

                                    <li class="ltn__category-menu-more-item-parent">
                                        <a class="rx-default">
                                            {{ getTranslatedWords('more categories') }} <span class="cat-thumb  icon-plus"></span>
                                        </a>
                                        <a class="rx-show">
                                            {{ getTranslatedWords('close menu') }} <span class="cat-thumb  icon-remove"></span>
                                        </a>
                                    </li>
                                    <!-- Single menu end -->
                                </ul>
                            </div>
                        </div>
                        <!-- END CATEGORY-MENU-LIST -->
                    </div>
                    <div class="col-lg-7">
                        <div class="col--- header-menu-column justify-content-center---">
                            <div class="header-menu header-menu-2 text-start">
                                <nav>
                                    <div class="ltn__main-menu">
                                        <ul>
                                            <li><a href="{{ route('home') }}">{{ getTranslatedWords('home') }}</a>
                                            </li>
                                            <li><a href="{{ route('shop') }}">{{ getTranslatedWords('shop') }}</a>
                                            </li>
                                            <li><a href="{{ route('show-offers') }}">{{ getTranslatedWords('offers') }}</a>
                                            </li>
                                            <li><a href="{{ route('about-us') }}">{{ getTranslatedWords('about us') }}</a>
                                            </li>
                                            <li><a href="{{ route('blog') }}">{{ getTranslatedWords('blog') }}</a>
                                            </li>
                                            <li><a href="{{ route('contact-us') }}">{{ getTranslatedWords('contact us') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-2 align-self-center d-none d-xl-block">
                        <div class="header-contact-info text-end">
                            <a class="font-weight-6 ltn__primary-color" href="tel:{{ settings('phone') }}"><span class="ltn__secondary-color"><i class="icon-call font-weight-7"></i></span>
                                {{ settings('phone') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-bottom-area end -->
    </header>
    <!-- HEADER AREA END -->

    <!-- Utilize Cart Menu Start -->
    <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        @include('front.components.cart_items')
    </div>
    <!-- Utilize Cart Menu End -->

    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="{{ route('home') }}"><img
                            src="{{ route('file_show', [settings('logo'), 'settings']) }}" alt="Logo"></a>
                </div>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="ltn__utilize-menu-search-form">
                <form action="{{ route('shop') }}" method="get">
                    @csrf
                    <input type="text" placeholder="{{ getTranslatedWords('search') }}">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="ltn__utilize-menu">
                <ul>
                    <li><a href="{{ route('home') }}">{{ getTranslatedWords('home') }}</a>
                    </li>
                    <li><a href="{{ route('shop') }}">{{ getTranslatedWords('shop') }}</a>
                    </li>
                    <li><a href="{{ route('about-us') }}">{{ getTranslatedWords('about us') }}</a>
                    </li>
                    <li><a href="{{ route('blog') }}">{{ getTranslatedWords('blog') }}</a>
                    </li>
                    <li><a href="{{ route('contact-us') }}">{{ getTranslatedWords('contact us') }}</a>
                    </li>
                </ul>
            </div>
            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>
                    @if (!auth()->guard('customer')->check())
                        <li>
                            <a href="{{ route('customer-login') }}" title="{{ getTranslatedWords('login') }}">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                {{ getTranslatedWords('login') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register-customer') }}" title="{{ getTranslatedWords('register') }}">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                {{ getTranslatedWords('register') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('customer-profile') }}" title="{{ getTranslatedWords('profile') }}">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                {{ getTranslatedWords('profile') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('whishlist') }}" title="{{ getTranslatedWords('whishlist') }}">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-heart"></i>
                                    <sup>{{ auth()->guard('customer')->user()->favourites()->count() }}</sup>
                                </span>
                                {{ getTranslatedWords('whishlist') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer-orders') }}" title="{{ getTranslatedWords('orders') }}">
                                <span class="utilize-btn-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <sup>{{ auth()->guard('customer')->user()->orders()->count() }}</sup>
                                </span>
                                {{ getTranslatedWords('orders') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer-reviews') }}" title="{{ getTranslatedWords('reviews') }}">
                                <span class="utilize-btn-icon">
                                    <i class="fas fa-star"></i>
                                    <sup>{{ auth()->guard('customer')->user()->reviews()->count() }}</sup>
                                </span>
                                {{ getTranslatedWords('reviews') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer-logout') }}" title="{{ getTranslatedWords('logout') }}">
                                <span class="utilize-btn-icon">
                                    <i class="fas fa-sign-out-alt"></i>

                                </span>
                                {{ getTranslatedWords('logout') }}
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('cart') }}" title="Shoping Cart">
                            <span class="utilize-btn-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <sup>{{ \Cart::getContent()->count() }}</sup>
                            </span>
                            {{ getTranslatedWords('cart') }}
                        </a>
                    </li>

                </ul>
            </div>
            <div class="ltn__social-media-2">
                <ul>
                    <li><a href="{{ settings('facebook') }}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li><a href="{{ settings('twitter') }}" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ settings('instagram') }}" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>

    @yield('content')

    <footer class="ltn__footer-area  ">
        <div class="footer-top-area  section-bg-2 plr--5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-about-widget">
                            <div class="footer-logo">
                                <div class="site-logo">
                                    <img src="{{ route('file_show', [settings('logo'), 'settings']) }}"
                                        alt="Logo">
                                </div>
                            </div>
                            <p>
                                {{ settings('footer_description') }}
                            </p>
                            <div class="footer-address">
                                <ul>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p>{{ settings('address') }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="tel:{{ settings('phone') }}">{{ settings('phone') }}</a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-mail"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="mailto:{{ settings('email') }}">{{ settings('email') }}</a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__social-media mt-20">
                                <ul>
                                    <li><a href="{{ settings('facebook') }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ settings('twitter') }}" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{ settings('instagram') }}" title="instagram"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">{{ getTranslatedWords('links') }}</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('about-us') }}">{{ getTranslatedWords('about us') }}</a>
                                    </li>
                                    <li><a href="{{ route('blog') }}">{{ getTranslatedWords('blog') }}</a></li>
                                    <li><a href="{{ route('shop') }}">{{ getTranslatedWords('shop') }}</a></li>
                                    <li><a href="{{ route('show-offers') }}">{{ getTranslatedWords('offers') }}</a>
                                    </li>
                                    <li><a href="{{ route('contact-us') }}">{{ getTranslatedWords('contact us') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">{{ getTranslatedWords('account') }}</h4>
                            <div class="footer-menu">
                                <ul>
                                    @if (!auth()->guard('customer')->check())
                                        <li><a href="{{ route('customer-login') }}">{{ getTranslatedWords('login') }}</a>
                                        </li>
                                        <li><a href="{{ route('register-customer') }}">{{ getTranslatedWords('register') }}</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('customer-profile') }}">{{ getTranslatedWords('profile') }}</a>
                                        </li>
                                        <li><a href="{{ route('whishlist') }}">{{ getTranslatedWords('whishlist') }}</a>
                                        </li>
                                        <li><a href="{{ route('customer-orders') }}">{{ getTranslatedWords('orders') }}</a>
                                        </li>
                                        <li><a href="{{ route('customer-reviews') }}">{{ getTranslatedWords('reviews') }}</a>
                                        </li>
                                        <li><a href="{{ route('customer-logout') }}">{{ getTranslatedWords('logout') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                        <div class="footer-widget footer-newsletter-widget">

                            <h5 class="mt-30">{{ getTranslatedWords('we accept') }}</h5>
                            <img src="{{ asset('website_assets/img/icons/payment-4.png') }}" alt="Payment Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
            <div class="container-fluid ltn__border-top-2">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="ltn__copyright-design clearfix">
                            <p>{{ getTranslatedWords('all rights reserved') }} @ {{ settings('system_name') }} <span class="current-year">{{ date('Y') }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 align-self-center">
                        <div class="ltn__copyright-menu text-end">
                            <ul>
                                <li><a href="{{ route('terms') }}">{{ getTranslatedWords('terms and conditions') }}</a>
                                </li>
                                <li><a href="{{ route('privacy') }}">{{ getTranslatedWords('privacy policy') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

</div>

<!-- preloader area start -->
<div class="preloader d-none" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->

<!-- All JS Plugins -->

<script src="{{ asset('website_assets/js/plugins.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Main JS -->
<script src="{{ asset('website_assets/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr['error']("{{ $error }}")
            @endforeach
        @endif
        @if (session()->has('success'))
            toastr['success']("{{ session()->get('success') }}")
        @elseif (session()->has('error'))
            toastr['error']("{{ session()->get('error') }}")
        @endif
    });
    $(document).on('click', '.btn-cart', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var qty = $(this).closest('ul').find("input[name='qtybutton']").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('addToCart') }}",
            method: 'post',
            data: {
                id: id,
                qty: qty
            },
            success: function(res) {


                if (res.status == 'success') {
                    toastr['success'](res.msg);
                    $('.ltn__utilize-cart-menu').html(res.items);
                    $('.mini-cart-icon sup').text(res.count);
                    $('.mini-cart-icon-2 h6 span.ltn__secondary-color').text(res.total);
                } else {
                    toastr['error'](
                        '{{ getTranslatedWords('error try later') }}');
                }





            },

            error: function() {
                alert("خطأ فى تحديث البيانات حاول لاحقا")
            }
        });
    })

    $(document).on('click', '.mini-cart-item-delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('RemoveFromCart') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(res) {


                if (res.status == 'success') {
                    toastr['success'](res.msg);
                    $('.ltn__utilize-cart-menu').html(res.items);
                    $('.mini-cart-icon sup').text(res.count);
                    $('.mini-cart-icon-2 h6 span.ltn__secondary-color').text(res.total);
                } else {
                    toastr['error'](
                        '{{ getTranslatedWords('error try later') }}');
                }





            },

            error: function() {
                alert("خطأ فى تحديث البيانات حاول لاحقا")
            }
        });
    })

    $(document).on('click', '.addRemoveWishlist', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('addRemoveWishlist') }}",
            method: 'post',
            data: {
                id: id,
            },
            success: function(res) {


                if (res.status == 'success') {
                    toastr['success'](res.msg);
                    //location.reload();
                } else {
                    toastr['error'](
                        '{{ getTranslatedWords('error try later') }}');
                }





            },

            error: function() {
                alert("خطأ فى تحديث البيانات حاول لاحقا")
            }
        });
    })

    $(document).on('click', '.cart-product-remove', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('addRemoveWishlist') }}",
            method: 'post',
            data: {
                id: id,
            },
            success: function(res) {


                if (res.status == 'success') {
                    toastr['success'](res.msg);
                    location.reload();
                } else {
                    toastr['error'](
                        '{{ getTranslatedWords('error try later') }}');
                }





            },

            error: function() {
                alert("خطأ فى تحديث البيانات حاول لاحقا")
            }
        });
    })

    
</script>
@yield('js')
</body>

</html>
