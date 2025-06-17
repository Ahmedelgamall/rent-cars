<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <link rel="stylesheet" href="{{asset('website_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('website_assets/css/bootstrap.min.css.map')}}" />
    <link
      rel="stylesheet"
      href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="{{asset('website_assets/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('website_assets/css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('website_assets/css/dropzone.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('website_assets/css/style.css')}}" />
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <style>
        body {
   
    direction: rtl;
}

h1,h2,h3,h4,h5,h6,p{
    font-family: "Cairo", sans-serif !important
}

.facebook-btn {
 
    margin-left: 5px;
    text-decoration: none
    
}

.twitter-btn {
    margin-right: 5px;
    text-decoration: none
}

.gts .st-ul {
    padding-right: 2rem;
    padding-left: 0
}

.accordion-button::after {
   
    margin-left: 0;
    margin-right: auto;
    
}

.home-container {
    
    background-image: url({{route('file_show', [settings('home_image'), 'settings'])}});
  
}
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <!-- <div class="container"></div> -->
      <a class="navbar-brand" href="{{route('home')}}"
          ><img class="logo" src="{{ route('file_show', [settings('logo'), 'settings']) }}" /><span
      >{{settings('system_name')}}</span
          ></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav-1 navbar-nav dropdown">
            <li class="nav-item dropdown">
              <a
                class="nav-link active"
                data-bs-toggle="dropdown"
                aria-current="page"
                href="{{route('home')}}"
            ><a class="home-link" href="{{route('home')}}">{{ getTranslatedWords('home') }}</a></a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link"
            href="{{route('about-us')}}"
               
              >
              {{ getTranslatedWords('about us') }}
              </a>
            </li>

            <li class="nav-item dropdown">
                <a
                  class="nav-link"
              href="{{route('cars')}}"
                 
                >
                {{ getTranslatedWords('cars') }}
                </a>
              </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="{{route('contact-us')}}"
               
              >
              {{ getTranslatedWords('contact us') }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    @yield('content')

    <footer style="margin-top:40px;">
      <div class="container">
        <div class="row">
          <!-- <div class="logo col-lg-2 col-md-12">WONDER</div> -->
          <div class="col-md-2 col-6">
            <ul>
            <li><a href="{{route('cars')}}">{{getTranslatedWords('cars')}}</a></li>
             
              <li><a href="{{route('about-us')}}">{{getTranslatedWords('about us')}}</a></li>
            </ul>
          </div>
          <div class="col-md-2 col-6">
            <ul>
              
                <li><a href="{{route('contact-us')}}">{{getTranslatedWords('contact us')}}</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-12">
            <p>
              {{settings('footer_description')}}
            </p>
          </div>
          <div class="col-lg-4 col-12 last-col">
          <h2>{{settings('phone')}}</h2>
          {{settings('email')}} <br />
          {{settings('address')}}
          </div>
        </div>
      </div>
      <hr />
      
    </footer>

    <script src="{{asset('website_assets/js/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('website_assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('website_assets/js/bootstrap.bundle.min.js.map')}}"></script>
    <script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('website_assets/select2.min.js')}}"></script>
    <script src="{{asset('website_assets/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr['error']("{{ $error }}")
            @endforeach
        @endif
        @if (session()->has('success'))
            toastr['success']("{{ session()->get('success') }}")
        @elseif (session()->has('error'))
            toastr['error']("{{ session()->get('error') }}")
        @endif
    });
</script>
    <script>
       $(document).ready(function() {
        $('.js-example-basic-single').select2({
          width: '100%',
          dropdownAutoWidth: true,
        });
      });
    </script>
    @stack('scripts')
  </body>
</html>