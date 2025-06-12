@extends('front.layouts.app')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ getTranslatedWords('blog') }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i
                                                class="fas fa-home"></i></span> {{ getTranslatedWords('home') }}</a></li>
                                <li>{{ getTranslatedWords('blog') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- BLOG AREA START -->
    <div class="ltn__blog-area ltn__blog-item-3-normal mb-100">
        <div class="container">
            <div class="row">
                <!-- Blog Item -->
                
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="ltn__blog-item ltn__blog-item-3">
                            <div class="ltn__blog-img">
                                <a href="{{ route('blog-details', $post->slug) }}"><img
                                        src="{{ route('file_show', [$post->image, 'settings']) }}" alt="#"></a>
                            </div>
                            <div class="ltn__blog-brief">

                                <h3 class="ltn__blog-title"><a
                                        href=" {{ route('blog-details', $post->slug) }} ">{{ $post->title }}</a></h3>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        <ul>
                                            <li class="ltn__blog-date"><i
                                                    class="far fa-calendar-alt"></i>{{ Carbon\Carbon::parse($post->created_at)->isoFormat('ll') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a
                                            href="{{ route('blog-details', $post->slug) }}">{{ getTranslatedWords('read more') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!--  -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->
@endsection
