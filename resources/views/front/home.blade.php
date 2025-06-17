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
          <h2>{{getTranslatedWords('Featured Cars')}}</h2>
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
          class="tab-pane fade show @if($loop->first) active @endif"
      id="pills-{{$cat->id}}"
          role="tabpanel"
          aria-labelledby="pills-{{$cat->id}}-tab"
          tabindex="0"
        >
              <div class="row">
                  @foreach (App\Models\Car::where('category_id',$cat->id) as $car)
                  <div class="col-lg-3 col-12 smallcard-col">
                    <div class="card smallcard">
                    <a href="{{route('car-info',$car->slug)}}"
                        ><img src=""
                      /></a>
                      <div class="card-body">
                      <a href="{{route('car-info',$car->slug)}}"><h5 class="card-title">{{$car->title}}</h5></a>
                      <div class="small-price">{{$car->price}}</div>
                        <hr />
                        <div class="card-text">
                          <div class="card-info">
                          <div class="small-year">{{$car->year_model}}</div>
                            <div class="small-opt">{{$car->model}}</div>
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

  <br />

  <div class="n">
    <div class="follow-us">
      <p>{{getTranslatedWords('Follow US')}}</p>
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
    <h1>Why Choose Us?</h1>
    <div class="container">
      <div class="row">
        <div class="box col-md-4 col-12">
          <div class="trust-icon1"><i class="fa-solid fa-star"></i></div>
          <h3>Wide range of brands</h3>
          <p>
            We can help with your financing plan, we can offer some tips and
            tricks. Drive off with this dream car of yours regardless of your
            credit history.
          </p>
        </div>
        <div class="box col-md-4 col-12">
          <div class="trust-icon2">
            <i class="fa-solid fa-check-to-slot"></i>
          </div>
          <h3>Trusted by our clients</h3>
          <p>
            We can help with your financing plan, we can offer some tips and
            tricks. Drive off with this dream car of yours regardless of your
            credit history.
          </p>
        </div>
        <div class="box col-md-4 col-12">
          <div class="trust-icon3"><i class="fa-solid fa-coins"></i></div>
          <h3>Fast & easy financing</h3>
          <p>
            We can help with your financing plan, we can offer some tips and
            tricks. Drive off with this dream car of yours regardless of your
            credit history.
          </p>
        </div>
      </div>
    </div>
  </div>

      <div class="faq-container">
      <div class="question-title">
        <h1>Frequently Asked Questions</h1>
      </div>

      <div class="row">
        <div class="col-12 bnn">
          <div class="accordion row" id="accordionExample">
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="true"
                    aria-controls="collapseOne"
                  >
                    Do you offer any sort of warranty?
                  </button>
                </h2>
                <div
                  id="collapseOne"
                  class="accordion-collapse collapse show"
                  aria-labelledby="headingOne"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                    aria-expanded="false"
                    aria-controls="collapseTwo"
                  >
                    When should I get my oil changed?
                  </button>
                </h2>
                <div
                  id="collapseTwo"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingTwo"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree"
                  >
                  What causes brake pulsation?
                  </button>
                </h2>
                <div
                  id="collapseThree"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingThree"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFour"
                    aria-expanded="false"
                    aria-controls="collapseFour"
                  >
                  Why is it important to rotate tires?
                  </button>
                </h2>
                <div
                  id="collapseFour"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFour"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFive"
                    aria-expanded="false"
                    aria-controls="collapseFive"
                  >
                  What is Auto Detailing?
                  </button>
                </h2>
                <div
                  id="collapseFive"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFive"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseSix"
                    aria-expanded="false"
                    aria-controls="collapseSix"
                  >
                    How do I check my tire pressure?
                  </button>
                </h2>
                <div
                  id="collapseSix"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingSix"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body">
                    We can help with your financing plan, we can offer some tips
                    and tricks. Drive off with this dream car of yours
                    regardless of your credit history.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
