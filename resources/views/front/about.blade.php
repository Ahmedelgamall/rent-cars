@extends('front.layouts.app')
@section('content')
<div class="container about-us">
<h1>{{getTranslatedWords('about us')}}</h1>
<div class="row">
  <div class="col-md-7 col-12">
    <h5>
      {{settings('about_us_title')}}
    </h5>
    <p class="about-us-p">
        {{settings('about_us_description')}}
    </p>
    
  </div>
  <div class="col-1"></div>
  <div class="col-md-4 col-12">
    <img src="{{ route('file_show', [settings('about_image'), 'settings']) }}" />

    <div
      class="follow-us"
      style="display: flex; justify-content: end; margin-top: 20px"
    >
      <p class="fc">{{getTranslatedWords('Follow US')}}</p>
      <div class="social-icons">
      <a class="social-a" target="_blank" href="{{settings('facebook_link')}}"><div class="social-icon"><i class="fa-brands fa-facebook"></i></div></a>
        <a class="social-a" target="_blank" href="{{settings('twitter_link')}}"><div class="social-icon"><i class="fa-brands fa-twitter"></i></div></a>
        <a class="social-a" target="_blank" href="{{settings('instagram_link')}}"><div class="social-icon"><i class="fa-brands fa-instagram"></i></div></a>  
      </div>
    </div>
  </div>
</div>
</div>

<div class="why-choose-us">
    <h1>{{getTranslatedWords('why choose us')}}</h1>
    <div class="container">
      <div class="row">
          @foreach (App\Models\WhyChooseUs::get() as $w)
          <div class="box col-md-4 col-12">
            <div class="trust-icon1"><img src="{{ route('file_show', [$w->image ?? '', 'settings']) }}"
                /></div>
            <h3>{{$w->title}}</h3>
            <p>
             {{$w->text}}
            </p>
          </div>
          @endforeach
        
      </div>
    </div>
  </div>

  <div class="faq-container">
    <div class="question-title">
      <h1>{{getTranslatedWords('faqs')}}</h1>
    </div>

    <div class="row">
      <div class="col-12 bnn">
        <div class="accordion row" id="accordionExample">
          @foreach (App\Models\Faq::get() as $f)
              <div class="col-12">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-{{$f->id}}">
                    <button
                      class="accordion-button @if(!$loop->first) collapsed @endif"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#collapse-{{$f->id}}"
                      aria-expanded="{{($loop->first)?'true':'false'}}"
                      aria-controls="collapse-{{$f->id}}"
                    >
                     {{$f->question}}
                    </button>
                  </h2>
                  <div
                  id="collapse-{{$f->id}}"
                 
                  aria-labelledby="heading-{{$f->id}}"
                  data-bs-parent="#accordionExample"
                id="collapse-{{$f->id}}"
                    class="accordion-collapse collapse @if($loop->first) show @endif" 
                    aria-labelledby="heading-{{$f->id}}"
                    data-bs-parent="#accordionExample"
                  >
                    <div class="accordion-body">
                        {{$f->answer}}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
        </div>
      </div>
    </div>
  </div>
   
    
@endsection
