@extends('front.layouts.app')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ getTranslatedWords('terms and conditions') }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i
                                                class="fas fa-home"></i></span> {{ getTranslatedWords('home') }}</a></li>
                                <li>{{ getTranslatedWords('terms and conditions') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START -->
    <div class="ltn__login-area pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">{{ getTranslatedWords('terms and conditions') }}
                            </h1>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-login-inner">
                        {!! settings('terms') !!}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->
@endsection
