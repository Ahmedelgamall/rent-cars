@extends('front.layouts.app')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "
        data-bs-bg="{{ route('file_show', [settings('cover_image'), 'settings']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ getTranslatedWords('contact us') }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home') }}"><span class="ltn__secondary-color"><i
                                                class="fas fa-home"></i></span> {{ getTranslatedWords('home') }}</a></li>
                                <li>{{ getTranslatedWords('contact us') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('website_assets/img/icons/10.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ getTranslatedWords('email') }}</h3>
                        <p>{{ settings('email') }}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('website_assets/img/icons/11.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ getTranslatedWords('phone') }}</h3>
                        <p>{{ settings('phone') }}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('website_assets/img/icons/12.png') }}" alt="Icon Image">
                        </div>
                        <h3>{{ getTranslatedWords('address') }}</h3>
                        <p>{{ settings('address') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->

    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">{{ getTranslatedWords('send contact message') }}</h4>
                        <form id="contact-form" action="{{ route('send-contact') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name"
                                            placeholder="{{ getTranslatedWords('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" name="email"
                                            placeholder="{{ getTranslatedWords('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone"
                                            placeholder="{{ getTranslatedWords('phone') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea name="message" placeholder="{{ getTranslatedWords('message') }}"></textarea>
                            </div>

                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                    type="submit">{{ getTranslatedWords('send') }}</button>
                            </div>
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map mb-120">

        <iframe
            src="https://maps.google.com/maps?q={{ urlencode(settings('address')) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    </div>
    <!-- GOOGLE MAP AREA END -->
@endsection
