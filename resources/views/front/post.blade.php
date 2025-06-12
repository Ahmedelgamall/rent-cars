@extends('front.layouts.app')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ $post->title }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('contact-us') }}"><span class="ltn__secondary-color"><i
                                                class="fas fa-home"></i></span> {{ getTranslatedWords('home') }}</a></li>
                                <li>{{ $post->title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
    <!-- PAGE DETAILS AREA START (blog-details) -->
    <div class="ltn__page-details-area ltn__blog-details-area mb-120">
        <div class="container">
            <div class="row">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">

                        <h2 class="ltn__blog-title">{{ $post->title }}
                        </h2>
                        {!! $post->body !!}
                    </div>
                    <hr>
                    <!-- related-post -->
                    <div class="related-post-area mb-50">
                        <h4 class="title-2">{{ getTranslatedWords('other posts') }}</h4>
                        <div class="row">
                            @foreach (App\Models\Blog::where('id', '!=', $post->id)->inRandomOrder()->take(20)->get() as $other_post)
                                <div class="col-md-6">
                                    <!-- Blog Item -->
                                    <div class="ltn__blog-item ltn__blog-item-6">
                                        <div class="ltn__blog-img">
                                            <a href="{{ route('blog-details', $other_post->slug) }}"><img src="{{ route('file_show',[$other_post->image,'settings']) }}"
                                                    alt="Image"></a>
                                        </div>
                                        <div class="ltn__blog-brief">
                                            <div class="ltn__blog-meta">
                                                <ul>
                                                    <li class="ltn__blog-date ltn__secondary-color">
                                                        <i class="far fa-calendar-alt"></i>{{ Carbon\Carbon::parse($other_post->created_at)->isoFormat('ll') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <h3 class="ltn__blog-title"><a href="{{ route('blog-details', $other_post->slug) }}">{{ $other_post->title }}</a></h3>
                                            <p>{!! Str::words($other_post->body,10) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE DETAILS AREA END -->
@endsection
