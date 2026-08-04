<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ Voyager::setting('site.title') }}</title>

  <!-- FAVICON AND TOUCH ICONS  -->
  <link rel="shortcut icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">
  <link rel="icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">
  {{-- <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png"> --}}
  {{-- <link rel="icon" href="images/apple-touch-icon.png" type="image/x-icon"> --}}

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900&amp;display=swap" rel="stylesheet">

  <!-- BOOTSTRAP CSS -->
  <link href="{{ asset('landingpage/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- FONT ICONS -->
  <link href="{{ asset('landingpage/use.fontawesome.com/releases/v5.11.0/css/all.css') }}" rel="stylesheet"
    crossorigin="anonymous">
  <link href="{{ asset('landingpage/css/flaticon.css') }}" rel="stylesheet">

  <!-- PLUGINS STYLESHEET -->
  <link href="{{ asset('landingpage/css/menu.css') }}" rel="stylesheet">
  <link id="effect" href="{{ asset('landingpage/css/dropdown-effects/fade-down.css') }}" media="all"
    rel="stylesheet">
  <link href="{{ asset('landingpage/css/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/css/flexslider.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/css/owl.theme.default.min.css') }}" rel="stylesheet">

  <!-- ON SCROLL ANIMATION -->
  <link href="{{ asset('landingpage/css/animate.css') }}" rel="stylesheet">

  <!-- TEMPLATE CSS -->
  <link href="{{ asset('landingpage/css/green.css') }}" rel="stylesheet">

  <!-- STYLE SWITCHER CSS -->
  <link href="{{ asset('landingpage/css/carrot.css') }}" rel="alternate stylesheet" title="carrot-theme">
  <link href="{{ asset('landingpage/css/dodgerblue.css') }}" rel="alternate stylesheet" title="dodgerblue-theme">
  <link href="{{ asset('landingpage/css/magneta.css') }}" rel="alternate stylesheet" title="magneta-theme">
  <link href="{{ asset('landingpage/css/olive.css') }}" rel="alternate stylesheet" title="olive-theme">
  <link href="{{ asset('landingpage/css/orange.css') }}" rel="alternate stylesheet" title="orange-theme">
  <link href="{{ asset('landingpage/css/purple.css') }}" rel="alternate stylesheet" title="purple-theme">
  <link href="{{ asset('landingpage/css/red.css') }}" rel="alternate stylesheet" title="red-theme">
  <link href="{{ asset('landingpage/css/skyblue.css') }}" rel="alternate stylesheet" title="skyblue-theme">
  <link href="{{ asset('landingpage/css/teal.css') }}" rel="alternate stylesheet" title="teal-theme">

  <!-- RESPONSIVE CSS -->
  <link href="{{ asset('landingpage/css/responsive.css') }}" rel="stylesheet">

  {{-- Flag --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.2.3/css/flag-icons.min.css"
    integrity="sha512-bZBu2H0+FGFz/stDN/L0k8J0G8qVsAL0ht1qg5kTwtAheiXwiRKyCq1frwfbSFSJN3jooR5kauE0YjtPzhZtJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  @yield('extra-css')
</head>

<body>
  <div id="loader-wrapper">
    <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          <div class="object" id="object_four"></div>
          <div class="object" id="object_three"></div>
          <div class="object" id="object_two"></div>
          <div class="object" id="object_one"></div>
        </div>
      </div>
    </div>
  </div>

  {{-- @dd($content->demo_image) --}}

  <div id="page" class="page">
    @yield('content')

    @php
      $user = \App\AccessUser::get();
      // dd($user);
      $count = \App\AccessTime::count();

      $online = \App\AccessTime::where('last_seen', '>=', now()->subMinutes(2))
          ->get()
          ->groupBy('access_user_id')
          ->count();
      $count_now = \App\AccessTime::whereDate('last_seen', \Carbon\Carbon::today())->count();
      // dd($count_now);
    @endphp

    <section id="contacts-2" class="bg-purple bg-pattern contacts-section division"
      style="background-image: url('{{ asset('storage/landing-pages/June2024/P6lGmDiSCyMpDZMCGqbI.jpg') }}')">
      <div class="container white-color">
        <div class="row">
          <!-- LOCATION -->
          <div class="col-md-4">
            <div class="contact-box icon-sm clearfix">
              <!-- Icon -->
              <img class="img-50" src="{{ asset('landingpage/images/icons/placeholder-4.png') }}" alt="clock-icon" />
              <!-- Text -->
              <div class="cbox-2-txt">
                <!-- Title -->
                <h5 class="h5-lg">{{ __('Address') }}:</h5>
                <!-- Title -->
                <p>
                  {{ session('website_language') === 'en' ? Voyager::setting('site-en.location') : Voyager::setting('site.location') }}
                </p>

                {{-- @dd(session('website_language') === 'en') --}}
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-box icon-sm clearfix">
              <!-- Icon -->
              <img class="img-50" src="{{ asset('landingpage/images/icons/contacts.png') }}" alt="clock-icon" />
              <!-- Text -->
              <div class="cbox-2-txt">
                <!-- Title -->
                <h5 class="h5-lg">{{ __('Contact') }}:</h5>
                <!-- Text -->
                <p>Hotline 1: <a href="tel:{{ Voyager::setting('site.phone') }}">{{ Voyager::setting('site.phone') }}</a></p>
                <p>Hotline 2: <a href="tel:{{ Voyager::setting('site.fax') }}">{{ Voyager::setting('site.fax') }}</a></p>
                <p><a href="mailto:{{ Voyager::setting('site.email') }}">{{ Voyager::setting('site.email') }}</a></p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-box clearfix">
              <!-- Icon -->
              <img class="img-50" src="{{ asset('landingpage/images/icons/clock-1.png') }}" alt="clock-icon" />
              <!-- Text -->
              <div class="cbox-2-txt">
                <!-- Title -->
                <h5 class="h5-lg">{{ __('Office Hours') }}:</h5>
                <!-- Text -->
                {{ session('website_language') === 'en' ? Voyager::setting('site-en.office_hours') : Voyager::setting('site.office_hours') }}
              </div>
              <span><strong>{{ __('Current number of visitors') }}:{{ $online }}</strong></span>
              <span><strong>{{ __('Number of visitors today') }}:{{ $count_now }}</strong></span>
              <span><strong>{{ __('Total number of visitors') }}:{{ $count }}</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('landingpage/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/modernizr.custom.js') }}"></script>
  <script src="{{ asset('landingpage/js/jquery.easing.js') }}"></script>
  <script src="{{ asset('landingpage/js/jquery.appear.js') }}"></script>
  <script src="{{ asset('landingpage/js/menu.js') }}"></script>
  <script src="{{ asset('landingpage/js/materialize.js') }}"></script>
  <script src="{{ asset('landingpage/js/jquery.scrollto.js') }}"></script>
  <script src="{{ asset('landingpage/js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/jquery.flexslider.js') }}"></script>
  <script src="{{ asset('landingpage/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/seo-form.js') }}"></script>
  <script src="{{ asset('landingpage/js/comment-form.js') }}"></script>
  {{-- <script src="{{ asset('landingpage/js/jquery.validate.min.js') }}"></script> --}}
  <script src="{{ asset('landingpage/js/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('landingpage/js/wow.js') }}"></script>

  <!-- Custom Script -->
  <script src="{{ asset('landingpage/js/custom.js') }}"></script>

  <script>
    new WOW().init();
  </script>

  <script src="{{ asset('landingpage/js/changer.js') }}"></script>
  <script defer src="{{ asset('landingpage/js/styleswitch.js') }}"></script>

  @yield('extra-js')
</body>

</html>
