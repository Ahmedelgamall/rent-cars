@extends('front.layouts.app')

@section('content')
<div class="content">
    <div class="continar home-container">
      <h1>{{settings('home_first_title')}}</h1>

      <div class="car-category">
        <h1>{{settings('home_second_title')}}</h1>
      </div>
    </div>
  </div>
    </div>
  </div>

  <div class="featured-listing">
    <div class="container">
      <div class="row">
        <div class="picked-hs col-md-6 col-xs-12">
          <h3>{{settings('system_name')}}</h3>
          <h2>{{getTranslatedWords('featured cars')}}</h2>
        </div>
        <div class="buttons col-md-6 col-xs-12">
          <div class="row">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach (App\Models\Category::take(4)->get() as $cat)
                <li class="nav-item" role="presentation">
                    <button
                      class="nav-link @if($loop->first) active @endif"
                id="pills-{{$cat->id}}-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#pills-{{$cat->id}}"
                      type="button"
                      role="tab"
                      aria-controls="pills-{{$cat->id}}"
                      aria-selected="true"
                    >
                      {{$cat->title}}
                    </button>
                  </li>
                @endforeach
              
              
            </ul>
          </div>
        </div>
      </div>

      <div class="tab-content" id="pills-tabContent">
        @foreach (App\Models\Category::take(4)->get() as $cat)
        <div
          class="tab-pane fade @if($loop->first) show active @endif"
      id="pills-{{$cat->id}}"
          role="tabpanel"
          aria-labelledby="pills-{{$cat->id}}-tab"
          tabindex="0"
        >
              <div class="row">
                  @foreach (App\Models\Car::where('category_id',$cat->id)->get() as $car)
                  <div class="col-lg-3 col-12 smallcard-col">
                    <div class="card smallcard">
                    <a href="{{route('car-info',$car->slug)}}"
                    ><img src="{{ route('file_show', [json_decode($car->images)[0], 'cars']) }}"
                      /></a>
                      <div class="card-body">
                      <a href="{{route('car-info',$car->slug)}}"><h5 class="card-title">{{$car->title}}</h5></a>
                      <div class="small-price">{{$car->price}}</div>
                        <hr />
                        <div class="card-text">
                          <div class="card-info">
                          <div class="small-year">{{$car->model}}</div>
                            <div class="small-opt">{{$car->year_model}}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                
                
               
              </div>
        </div>
        @endforeach
       
      </div>
    </div>
  </div>

  <br />

  <div class="n">
    <div class="follow-us">
      <p>{{getTranslatedWords('follow us')}}</p>
      <div class="social-icons">
      <a class="social-a" target="_blank" href="{{settings('facebook_link')}}"><div class="social-icon"><i class="fa-brands fa-facebook"></i></div></a>
        <a class="social-a" target="_blank" href="{{settings('twitter_link')}}"><div class="social-icon"><i class="fa-brands fa-twitter"></i></div></a>
        <a class="social-a" target="_blank" href="{{settings('instagram_link')}}"><div class="social-icon"><i class="fa-brands fa-instagram"></i></div></a>  
      </div>
    </div>

    <div class="view-btn">
      <button>
      <a style="text-decoration: none; color: white" href="{{route('cars')}}"
          >{{getTranslatedWords('show more')}}</a
        >
      </button>
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
