@extends('front.layouts.app')
@section('content')
<div class="container message" style="background-color:white">
    <div class="row">
        <div class="col-md-4 col-12">
            <h2 style="font-weight: 800; font-size:40px;">{{getTranslatedWords('contact us')}}</h2>
            <p>{{settings('address')}}</p>
            <h3>{{settings('phone')}}</h3>
            <p> <i class="fa-solid fa-envelope"></i> {{settings('email')}}</p>
            <div class="follow-us" style="display: flex;">
                <p>{{getTranslatedWords('Follow US')}}</p>
                <div class="social-icons" style="display: flex; padding-top: 15px;">
                    <a class="social-a" target="_blank" href="{{settings('facebook_link')}}"><div class="social-icon"><i class="fa-brands fa-facebook"></i></div></a>
                      <a class="social-a" target="_blank" href="{{settings('twitter_link')}}"><div class="social-icon"><i class="fa-brands fa-twitter"></i></div></a>
                      <a class="social-a" target="_blank" href="{{settings('instagram_link')}}"><div class="social-icon"><i class="fa-brands fa-instagram"></i></div></a>  
                    </div>
               
            </div>
        </div>
        <div class="col-md-2 col-12"></div>
        <div class="col-md-6 col-12" style="background-color: aliceblue; border-radius: 10px;">
        <form action="{{route('send-contact')}}" action="" method="post">
            @csrf
            <div class="row" style="padding: 12px;">
                <div class="col-4 input-field"><input placeholder="{{getTranslatedWords('name')}}" type="text" name="name" /></div>
                <div class="col-4 input-field"><input placeholder="{{getTranslatedWords('email')}}" type="email" name="email" /></div>
                <div class="col-4 input-field"><input placeholder="{{getTranslatedWords('phone')}}" type="number" name="phone" /></div>
                <div class="col-12 client-message">
                    <input class="client-message-input" placeholder="{{getTranslatedWords('message')}}*" name="message" type="text" />
                </div>
                <div class="row accept-package">
                   
                    <button type="submit" class="col-6">{{getTranslatedWords('send')}}</button>
                </div>
            </div>
        </form>
            
        </div>
    </div>
</div>
</div>

<div class="maps" style="display: flex; justify-content:center;">
    <iframe src="https://maps.google.com/maps?q={{ urlencode(settings('address')) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
        width="1290" height="500" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
   
@endsection
