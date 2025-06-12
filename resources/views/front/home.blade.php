@extends('front.layouts.app')
@section('css')
    <style>
        .slick-slide img {
            width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content')
    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1 mb-30">
                        @foreach (App\Models\Slider::get() as $slider)
                            <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image"
                                data-bs-bg="{{ route('file_show', [$slider->image, 'settings']) }}">
                                <div class="ltn__slide-item-inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="slide-item-info">
                                                <div class="slide-item-info-inner ltn__slide-animation">

                                                    <h1 class="slide-title  animated">{{ $slider->title }}</h1>
                                                    <div class="slide-brief animated d-none">
                                                        <p>{{ $slider->text }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SLIDER AREA END -->

    <!-- CATEGORY AREA START -->
    <div class="ltn__category-area section-bg-1-- pt-30 pb-50">
        <div class="container">
            <div class="row ltn__category-slider-active-six slick-arrow-1 border-bottom">
                @foreach (App\Models\Category::whereNull('parent_id')->get() as $category)
                    <div class="col-12">
                        <div class="ltn__category-item ltn__category-item-6 text-center">
                            <div class="ltn__category-item-img">
                                <a href="{{ route('shop', ['category' => $category->id]) }}">
                                    <img src="{{ route('file_show', [$category->image, 'categories']) }}" class="img-fluid"
                                        alt="">
                                </a>
                            </div>
                            <div class="ltn__category-item-name">
                                <h6><a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- CATEGORY AREA END -->

    <!-- SMALL PRODUCT LIST AREA START -->
    <div class="ltn__small-product-list-area section-bg-1 pt-115 pb-90 mt-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">{{ getTranslatedWords('best seller') }}</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- small-product-item -->
                @foreach (App\Models\Product::where('is_best_seller', 1)->take(15)->get() as $best_product)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="ltn__small-product-item">
                            <div class="small-product-item-img">
                                <a href="{{ route('product-details', $best_product->slug) }}"><img
                                        src="{{ route('file_show', [json_decode($best_product->images)[0], 'products']) }}"
                                        alt="Image"></a>
                            </div>
                            <div class="small-product-item-info">
                                <h2 class="product-title"><a
                                        href="{{ route('product-details', $best_product->slug) }}">{{ $best_product->name }}</a>
                                </h2>
                                <div class="product-price">
                                    <span>{{ $best_product->price }} {{ getTranslatedWords('L.E') }}</span>
                                    @if ($best_product->price_before != '')
                                        <del>{{ $best_product->price_before }} {{ getTranslatedWords('L.E') }}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!--  -->
            </div>
        </div>
    </div>
    <!-- SMALL PRODUCT LIST AREA END -->

    <!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area bg-image pt-115 pb-110"
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <!-- <img src="img/others/7.png" alt="About Us Image"> -->
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2--- mb-20">

                            <h1 class="section-title">{{ settings('about_us_title') }}</h1>
                            <p>{{ settings('about_us_description') }}</p>
                        </div>
                        {{-- <ul class="ltn__list-item-half clearfix">
                            <li>
                                <i class="flaticon-home-2"></i>
                                Activated Carbon
                            </li>
                            <li>
                                <i class="flaticon-mountain"></i>
                                Breathing Valve
                            </li>
                            <li>
                                <i class="flaticon-heart"></i>
                                6 Layer Filteration
                            </li>
                            <li>
                                <i class="flaticon-secure"></i>
                                Rewashes & Reusable
                            </li>
                        </ul>
                        <div class="btn-wrapper animated">
                            <a href="service.html"
                                class="ltn__secondary-color text-uppercase text-decoration-underline">View Products</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <div class="ltn__blog-area pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color d-none">
                            {{ getTranslatedWords('blog') }}</h6>
                        <h1 class="section-title">{{ getTranslatedWords('latest blogs') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                <!-- Blog Item -->
                @foreach (App\Models\Blog::latest()->take(15)->get() as $latest_blog)
                    <div class="col-lg-12">
                        <div class="ltn__blog-item ltn__blog-item-3">
                            <div class="ltn__blog-img">
                                <a href="{{ route('blog-details', $latest_blog->slug) }}"><img
                                        src="{{ route('file_show', [$latest_blog->image, 'settings']) }}"
                                        alt="#"></a>
                            </div>
                            <div class="ltn__blog-brief">

                                <h3 class="ltn__blog-title"><a
                                        href="{{ route('blog-details', $latest_blog->slug) }}"></a>{{ $latest_blog->title }}
                                </h3>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        <ul>
                                            <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>
                                                {{ Carbon\Carbon::parse($latest_blog->created_at)->isoFormat('ll') }}</li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a
                                            href="{{ route('blog-details', $latest_blog->slug) }}">{{ getTranslatedWords('read more') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->

    <!-- FEATURE AREA START ( Feature - 3) -->
    <div class="ltn__feature-area section-bg-1 mt-90--- pt-30 pb-30 mt--65---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border--- section-bg-1">
                        @foreach (App\Models\Feature::get() as $feature)
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="{{ route('file_show', [$feature->image, 'settings']) }}" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>{{ $feature->title }}</h4>
                                    <p>{{ $feature->text }}</p>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->
@endsection
