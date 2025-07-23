@extends('front.layouts.app')
@section('content')
<div class="page-num">
    <button>
    <a class="home-btn" target="_blank" href="{{route('home')}}">{{getTranslatedWords('home')}}</a>
    </button>
    -
    <button>
      <a class="home-btn" target="_blank" href="{{route('cars',['category_id'=>$car->category_id])}}">{{$car->category->title}}</a>
    </button>
    -
    <span style="margin-left: 4px">{{$car->title}}</span>
  </div>

  <div class="container gts">
    <div class="row">
      <div class="col-md-8 col-12">
        <div class="swiper mySwiper2">
          <div class="swiper-wrapper swiper-bigphoto">
              @foreach (json_decode($car->images) as $img)
              <div class="swiper-slide">
                <img src="{{ route('file_show', [$img, 'cars']) }}" />
              </div>
              @endforeach
           
            
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
        <div thumbsSlider="" class="swiper mySwiper">
          <div class="swiper-wrapper">
            @foreach (json_decode($car->images) as $img)
            <div class="swiper-slide">
              <img src="{{ route('file_show', [$img, 'cars']) }}" />
            </div>
            @endforeach
          </div>
        </div>
          <h4>{{getTranslatedWords('description')}}</h4>

          <p class="addReadMore showlesscontent">{{$car->description}}</p>
      </div>
      <div class="col-md-4 col-12 gts-info">
        <h1>{{$car->title}}</h1>
        <ul class="st-ul">
          <li>{{$car->category->title}}</li>
          <li>{{$car->model}}</li>
          {{--<li>{{$car->year_model}}</li>
          <li>{{$car->kilometers}} {{getTranslatedWords('km')}}</li>--}}
        </ul>
        <hr />
        <h2>{{$car->price}} {{getTranslatedWords('L.E')}}</h2>
        <div class="gts-options">
          <div class="col-6 st">
            <ul>
              @foreach ($car->attributes()->get() as $att)
              <li>{{$att->key}}</li>
              @endforeach
            </ul>
          </div>
          <div class="col-6 sec">
            <ul>
                @foreach ($car->attributes()->get() as $att)
                <li>{{$att->value}}</li>
                @endforeach
            </ul>
          </div>
        </div>
       
       
        
        <div class="gts-social-buttons">
          <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="facebook-btn">
            <i class="fa-brands fa-facebook"></i> {{getTranslatedWords('share')}}
          </a>
          <a href="https://twitter.com/intent/tweet?url={{url()->current()}}&text={{$car->title}}" class="twitter-btn">
            <i class="fa-brands fa-twitter"></i> {{getTranslatedWords('tweet')}}
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container message">
    <h4>{{getTranslatedWords('order car')}}</h4>
    <form action="{{route('order-car')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
              <div class="row">
                  <input type="hidden" name="car_id" value="{{$car->id}}">
                <div class="col-4 input-field"><input name="name" placeholder="{{getTranslatedWords('name')}}" type="text" /></div>
                <div class="col-4 input-field"><input name="email" placeholder="{{getTranslatedWords('email')}}" type="email" /></div>
                <div class="col-4 input-field"><input name="phone" placeholder="{{getTranslatedWords('phone')}}" type="number" /></div>
                <div class="col-12 client-message">
                  <input class="client-message-input" name="message" placeholder="{{getTranslatedWords('message')}}*" type="text" />
                </div>
                <div class="row accept-package">
                   
                    <button type="submit" class="col-6">{{getTranslatedWords('send')}}</button>
                </div>
              </div>
            </div>
            
           
          </div>
    </form>
    
  </div>


  <div class="container Related-listing">
    <h4>{{getTranslatedWords('related cars')}}</h4>
    
    <!-- Swiper -->
<div class="my-second-Swiper"> 
  <div class="swiper-wrapper">
   
    @foreach ($related as $r)
    <div class="swiper-slide" data-swiper-autoplay="2000">
        <div class="card">
        <div class="card second-swipper-card">
          <a href="{{route('car-info',$r->slug)}}" target="_blank" ><img src="{{ route('file_show', [json_decode($r->images)[0], 'cars']) }}"/></a>
          <div class="card-body">
            <h5 class="card-title">{{$r->title}}</h5>
          <div class="small-price">{{$r->price}} {{getTranslatedWords('L.E')}}</div>
            <hr />
            <div class="card-text">
              <div class="card-info">
                <div class="small-year">{{$r->category->title}}</div>
                <div class="small-gear">{{$r->model}}</div>
                <div class="small-engine">{{$r->year_model}}</div>
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
@endsection
