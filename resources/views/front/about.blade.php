@extends('front.layouts.app')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ getTranslatedWords('about us') }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i
                                                class="fas fa-home"></i></span> {{ getTranslatedWords('home') }}</a></li>
                                <li>{{ getTranslatedWords('about us') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area pt-25--- pb-120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <img src="{{ route('file_show', [settings('about_image'), 'settings']) }}" alt="About Us Image">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2--- mb-30">
                            <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color d-none">
                                {{ getTranslatedWords('about us') }}</h6>
                            <h1 class="section-title">{{ settings('about_us_title') }}</h1>
                            <p>{{ settings('about_us_description') }}</p>
                        </div>

                        <div class="about-author-info-2 border-top mt-30 pt-20">
                            <ul>
                                <li>
                                    <div class="about-author-info-2-contact  d-flex">
                                        <div class="about-contact-icon d-flex align-self-center mr-10">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="about-author-info-2-contact-info">
                                            <small>{{ getTranslatedWords('get Support') }}</small>
                                            <h6 class="mb-0">{{ settings('phone') }}</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US AREA END -->


    <!-- FEATURE AREA START ( Feature - 6) -->
    <div class="ltn__feature-area pt-90 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h1 class="section-title">{{ getTranslatedWords('our features') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter">
                @foreach (App\Models\Feature::get() as $feature)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="ltn__feature-item ltn__feature-item-6 text-center">
                            <div class="ltn__feature-icon">
                                <!-- <span><i class="flaticon-apartment"></i></span> -->
                                <img src="{{ route('file_show', [$feature->image, 'settings']) }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4><a>{{ $feature->title }}</a></h4>
                                <p>{{ $feature->text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->


    <!-- COUNTER UP AREA START -->
    <div class="ltn__counterup-area section-bg-1 bg-image bg-overlay-theme-black-80--- pt-115 pb-70"
        data-bs-bg="{{ asset('website_assets/img/bg/30.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="img/icons/icon-img/2.png" alt="#">  -->
                            <i class="flaticon-add-user-1"></i>
                        </div>
                        <h1><span class="counter">{{ App\Models\Customer::count() }}</span><span
                                class="counterUp-icon">+</span> </h1>
                        <h6>{{ getTranslatedWords('active clients') }}</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="img/icons/icon-img/3.png" alt="#">  -->
                            <i class="flaticon-add-to-cart"></i>
                        </div>
                        <h1><span class="counter">{{ App\Models\Order::count() }}</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ getTranslatedWords('orders') }}</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="img/icons/icon-img/3.png" alt="#">  -->
                            <i class="flaticon-buy-home"></i>
                        </div>
                        <h1><span class="counter">{{ App\Models\Product::count() }}</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ getTranslatedWords('products') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUNTER UP AREA END -->

    <!-- TESTIMONIAL AREA START (testimonial-4) -->
    <div class="ltn__testimonial-area section-bg-1 pt-290 pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">{{ getTranslatedWords('testimonials') }}<span>.</span></h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__testimonial-slider-3-active slick-arrow-1 slick-arrow-1-inner">
                @foreach (App\Models\Testimonial::inRandomOrder()->take(20)->get() as $testimonial)
                    <div class="col-lg-12">
                        <div class="ltn__testimonial-item ltn__testimonial-item-4">
                            <div class="ltn__testimoni-img">
                                <img src="{{ route('file_show', [$testimonial->image, 'settings']) }}" alt="#">
                            </div>
                            <div class="ltn__testimoni-info">
                                <p>{{ $testimonial->opinion }}</p>
                                <h4>{{ $testimonial->name }}</h4>
                                <h6>{{ $testimonial->job }}</h6>
                            </div>
                            <div class="ltn__testimoni-bg-icon">
                                <i class="far fa-comments"></i>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!--  -->
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL AREA END -->

    <!-- FAQ AREA START (faq-2) (ID > accordion_2) -->
    <div class="ltn__faq-area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title white-color---">{{ getTranslatedWords('faqs') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ltn__faq-inner ltn__faq-inner-2">
                        <div id="accordion_2">
                            <!-- card -->
                            @foreach (App\Models\Faq::get() as $faq)
                                <div class="card">
                                    <h6 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                        data-bs-target="#faq-item-{{ $faq->id }}" aria-expanded="false">
                                       {{$faq->question}}
                                    </h6>
                                    <div id="faq-item-{{ $faq->id }}" class="collapse" data-bs-parent="#accordion_2">
                                        <div class="card-body">
                                            <p>{{$faq->answer}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- card -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <aside class="about-us-img-wrap about-img-right">
                        <img src="{{ route('file_show',[settings('faq_image'),'settings']) }}" alt="Banner Image">
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ AREA START -->

    
@endsection
