<!-- beautify ignore:start -->
<html
  @if (App::getLocale() == 'ar') dir="rtl" lang="ar" @else dir="ltr" lang="en" @endif
  class="light-style layout-menu-fixed"
  data-theme="theme-default"
  data-assets-path="{{ asset('new_assets') }}/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ settings('system_name') }} | @yield('title')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ route('file_show', [settings('logo'), 'settings']) }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link href="{{ asset('new_assets/vendor/fonts/boxicons.css') }}" rel="stylesheet" />


  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('new_assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('new_assets/vendor/css/theme.css') }}" class="template-customizer-theme-css" />
 

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('new_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <link rel="stylesheet" href="{{ asset('new_assets/vendor/libs/apex-charts/apex-charts.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('new_assets/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('new_assets/js/config.js') }}"></script>
  <style>
    .special:before {


      width: 0 !important;
    }

    .page-item.first .page-link, .page-item.last .page-link, .page-item.next .page-link, .page-item.prev .page-link, .page-item.previous .page-link {
  
      padding: 0.625rem 0.5125rem;
    }

    .page-item.active .page-link {
      margin: 0 0.3rem 0 0.3rem;
    }
    
    div.dataTables_wrapper div.dataTables_info {
    padding-top: 1.5em;
   
}

div.dataTables_wrapper div.dataTables_paginate {
    margin: 1.5em 0 !important;
   
}

.card .btn-primary {
  margin: 0.5em 1em;
}

.avatar .avatar-initial {
   
    padding: 5px;
}

div.dataTables_wrapper div.dataTables_filter {
  margin-top: 2em
}
  </style>
  
  @if (App::getLocale() == 'ar')
<link href="{{ asset('assets/tajawal.css') }}" rel="stylesheet" />
  <style>
    body {
      font-family: 'tajawal', 'sans serif'
    }

    .menu-vertical .menu-item .menu-toggle::after {

      right: auto;
      left: 1rem;
    }

    .menu-toggle::after {

      transform: translateY(-50%) rotate(220deg);
    }

    .menu-vertical .menu-item .menu-toggle {
      padding-right: 1rem;

    }

    .menu-icon {

      margin-right: 0;
    }

    .me-3 {
      margin-right: 0 !important;
      margin-left: 1rem !important;
    }

    .me-2 {
      margin-right: 0 !important;
      margin-left: 0.5rem !important;
    }

    .dropdown-item {

      text-align: right;
    }

    @media (min-width: 1200px) {

      .layout-menu-fixed:not(.layout-menu-collapsed) .layout-page,
      .layout-menu-fixed-offcanvas:not(.layout-menu-collapsed) .layout-page {
        padding-left: inherit;
        padding-right: 16.25rem;
      }
    }

    @media (min-width: 1200px) {

      .layout-menu-fixed .layout-menu,
      .layout-menu-fixed-offcanvas .layout-menu {

        left: auto;
        right: 0
      }
    }

    .ms-auto {
    
      margin-left: 0 !important;
      margin-right: auto !important;
    }

    .dropdown-menu-end[data-bs-popper] {
    right: 0;
    left: auto;
    right: auto;
    left: 0;
}

@media (max-width: 1199.98px) {
    .layout-menu-expanded .layout-menu {
     
        left: auto !important;
        right: 0 !important;
    }
}



div.dataTables_wrapper div.dataTables_filter {
  float: left
}

  </style>
@endif

  @yield('css')
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo mt-3">
          <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img class="img-fluid" width="100" src=" {{ route('file_show', [settings('logo'), 'settings']) }} " alt="homepage">

            </span>

          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item @if (\Route::is('dashboard')) active @endif">
            <a href="{{ route('dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">{{ getTranslatedWords('home') }}</div>
            </a>
          </li>

          <!-- Layouts -->
 @if (auth()->user()->can('list sliders') || auth()->user()->can('list blogs') || auth()->user()->can('edit settings') || auth()->user()->can('list faqs') || auth()->user()->can('list testimonials') || auth()->user()->can('list features') || auth()->user()->can('list why choose us') || auth()->user()->can('list cities') || auth()->user()->can('list areas'))
<li class="menu-item @if (\Route::is('sliders.*') || \Route::is('settings.*') || \Route::is('blogs.*') || \Route::is('features.*') || \Route::is('faqs.*') || \Route::is('testimonials.*') || \Route::is('why-us.*') || \Route::is('cities.*') || \Route::is('areas.*')) open active @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-cog"></i>
              <div data-i18n="Layouts">{{ getTranslatedWords('system settings') }}</div>
            </a>

            <ul class="menu-sub">
            
              @can('list features')
    <li class="menu-item">
                                            <a href="{{ route('features.index') }}" class="menu-link">
                                              <div data-i18n="Without navbar">{{ getTranslatedWords('features') }}</div>
                                            </a>
                    </li>
@endcan
    @can('list sliders')
    <li class="menu-item">
                      <a href="{{ route('sliders.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ getTranslatedWords('sliders') }}</div>
                      </a>
                </li>
@endcan
   
@can('list blogs')
    <li class="menu-item">
                  <a href="{{ route('blogs.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('blogs') }}</div>
                  </a>
                </li>
@endcan
@can('list faqs')
    <li class="menu-item">
                  <a href="{{ route('faqs.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('faqs') }}</div>
                  </a>
                </li>
@endcan
@can('list testimonials')
    <li class="menu-item">
                  <a href="{{ route('testimonials.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('testimonials') }}</div>
                  </a>
                </li>
@endcan


@can('list why choose us')
    <li class="menu-item">
                  <a href="{{ route('why-us.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('why choose us') }}</div>
                  </a>
                </li>
@endcan

@can('list cities')
    <li class="menu-item">
                  <a href="{{ route('cities.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('cities') }}</div>
                  </a>
                </li>
@endcan

@can('list areas')
    <li class="menu-item">
                  <a href="{{ route('areas.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">{{ getTranslatedWords('areas') }}</div>
                  </a>
                </li>
@endcan
           @can('edit settings')
    <li class="menu-item">
                                            <a href="{{ route('settings.index') }}" class="menu-link">
                                              <div data-i18n="Without navbar">{{ getTranslatedWords('settings') }}</div>
                                            </a>
                                          </li>
@endcan

             
   
            </ul>
            </li>
@endif


            @if (auth()->user()->can('list roles') || auth()->user()->can('list admins'))
<li class="menu-item @if (\Route::is('admins.*') || \Route::is('roles.*')) open active @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-user-check"></i>
              <div data-i18n="Layouts">{{ getTranslatedWords('admins and roles') }}</div>
            </a>

            <ul class="menu-sub">
              @can('list admins')
    <li class="menu-item">
                                        <a href="{{ route('admins.index') }}" class="menu-link">
                                          <div data-i18n="Without navbar">{{ getTranslatedWords('admins') }}</div>
                                        </a>
                                      </li>
@endcan
              @can('list roles')
    <li class="menu-item">
                                        <a href="{{ route('roles.index') }}" class="menu-link">
                                          <div data-i18n="Without navbar">{{ getTranslatedWords('roles') }}</div>
                                        </a>
                                      </li>
@endcan
            </ul>
          </li>
@endif

 @if (auth()->user()->can('list categories') || auth()->user()->can('list products'))
<li class="menu-item @if (\Route::is('categories.*') || \Route::is('products.*') || \Route::is('offers.*')) open active @endif">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-package"></i>
               <div data-i18n="Layouts">{{ getTranslatedWords('products') }}</div>
             </a>
 
             <ul class="menu-sub">
               @can('list categories')
    <li class="menu-item">
                                     <a href="{{ route('categories.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('categories') }}</div>
                                     </a>
                                   </li>
@endcan
               @can('list products')
    <li class="menu-item">
                                     <a href="{{ route('products.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('products') }}</div>
                                     </a>
                                   </li>

                                   <li class="menu-item">
                                    <a href="{{ route('products.best_seller') }}" class="menu-link">
                                      <div data-i18n="Without navbar">{{ getTranslatedWords('best seller products') }}</div>
                                    </a>
                                  </li>

                                  <li class="menu-item">
                                    <a href="{{ route('offers.index') }}" class="menu-link">
                                      <div data-i18n="Without navbar">{{ getTranslatedWords('offers') }}</div>
                                    </a>
                                  </li>
@endcan
             </ul>
           </li>
@endif


 @if (auth()->user()->can('list customers') || auth()->user()->can('list contacts'))
<li class="menu-item @if (\Route::is('customers.*') || \Route::is('contacts.*')) open active @endif">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-user"></i>
               <div data-i18n="Layouts">{{ getTranslatedWords('customers') }}</div>
             </a>
 
             <ul class="menu-sub">
               @can('list customers')
    <li class="menu-item">
                                     <a href="{{ route('customers.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('customers') }}</div>
                                     </a>
                                   </li>
@endcan
               @can('list contacts')
    <li class="menu-item">
                                     <a href="{{ route('contacts.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('contacts') }}</div>
                                     </a>
                                   </li>
@endcan
             </ul>
           </li>
@endif

 @if (auth()->user()->can('list orders') || auth()->user()->can('list coupons'))
<li class="menu-item @if (\Route::is('orders.*') || \Route::is('coupons.*')) open active @endif">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
               <div data-i18n="Layouts">{{ getTranslatedWords('orders') }}</div>
             </a>
 
             <ul class="menu-sub">
               @can('list orders')
    <li class="menu-item">
                                     <a href="{{ route('orders.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('orders') }}</div>
                                     </a>
                                   </li>
@endcan
               @can('list coupons')
    <li class="menu-item">
                                     <a href="{{ route('coupons.index') }}" class="menu-link">
                                       <div data-i18n="Without navbar">{{ getTranslatedWords('coupons') }}</div>
                                     </a>
                                   </li>
@endcan
             </ul>
           </li>
@endif
             
   
          
          

           
           
       


        </ul>
      </aside>
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">

            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">

            {{-- <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a  href="@if (App::getLocale() == 'ar') {{ LaravelLocalization::getLocalizedURL('en', null, [], true) }} @else {{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }} @endif" class="nav-link hide-arrow">
                      <i class="bx bx-globe" style="font-size:1.4em"></i>
                     
                </a>
                
                 
                 
                 
                 
            </li> --}}

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a  id="make_notifications_read" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="bx bx-bell" style="font-size:1.4em"></i>
                    @if (auth()->user()->unreadNotifications()->count())
<span class="notifications_count flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">{{ auth()->user()->unreadNotifications()->count() }}</span>
@endif
              </a>
               <ul class="dropdown-menu dropdown-menu-end">
                    @foreach (auth()->user()->notifications()->latest()->take(7)->get() as $key => $notification)
<li><a class="dropdown-item"
                                          href="javascript:void(0);">
                                      @foreach ($notification->data as $d)
@endforeach
                                      {{ $notification->data['message:' . app()->getLocale()] }}</a>
                                  </li>
@endforeach
                               <a href="{{ route('myNotifications') }}"
                      class="btn btn-primary mt-2 mb-2 d-block text-center">{{ getTranslatedWords('show all') }}</a>
               </ul>
               
               
               
               
          </li>
           
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a id="" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="
                        @if (auth()->user()->profile_image != '') {{ route('file_show', ['filename' => auth()->user()->profile_image, 'path' => 'settings']) }}
                            @else
                            {{ asset('new_assets/img/avatars/1.png') }} @endif" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="@if (auth()->user()->profile_image != '') {{ route('file_show', ['filename' => auth()->user()->profile_image, 'path' => 'settings']) }}
                                @else
                                {{ asset('new_assets/img/avatars/1.png') }} @endif" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>

                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">{{ getTranslatedWords('profile') }}</span>
                    </a>
                  </li>
                 
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">{{ getTranslatedWords('logout') }} </span>
                    </a>
                  </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        @yield('content')
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Menu -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('new_assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('new_assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('new_assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('new_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
  <script src="{{ asset('new_assets/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('new_assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('new_assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('new_assets/js/dashboards-analytics.js') }}"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script>
      $(document).ready(function() {
          //toastr['success']('مرحبا');

          @if (session()->has('success'))
              toastr['success']("{{ session()->get('success') }}")
          @endif
          @if (session()->has('error'))
              toastr['error']("{{ session()->get('error') }}")
          @endif

      })

      $(document).on('click', '#make_notifications_read', function() {

          $.get("{{ route('markReadNotifications') }}", function(data) {
              $(".notifications_count").hide();

          });
      });
  </script>
  @yield('js')
</body>

</html>
