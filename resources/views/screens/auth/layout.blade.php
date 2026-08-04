<!doctype html>
<html lang="{{ App::getLocale() }}">

<head>
  <title>{{ Voyager::setting('site.title') }} - {{ __('Account') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    body, h1, h2, h3, h4, h5, h6, .auth-page-header, #sidebar {
      font-family: 'Plus Jakarta Sans', 'Be Vietnam Pro', system-ui, -apple-system, sans-serif !important;
    }
    body {
      background-color: #fbf2ed;
      color: #334155;
    }
    #sidebar {
      background: linear-gradient(180deg, #8e1c19 0%, #5c1210 100%) !important;
      min-width: 280px;
      max-width: 280px;
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
      z-index: 99;
    }
    #sidebar .logo {
      font-size: 1.4rem;
      font-weight: 800;
      color: #ffffff;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      text-decoration: none;
    }
    #sidebar ul.components {
      padding: 0;
    }
    #sidebar ul.components li a {
      padding: 12px 18px;
      font-size: 0.925rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.85);
      border-radius: 16px;
      margin-bottom: 6px;
      transition: all 0.25s ease;
      display: flex;
      align-items: center;
      text-decoration: none;
    }
    #sidebar ul.components li a:hover {
      background: rgba(255, 255, 255, 0.12);
      color: #ffffff;
      transform: translateX(4px);
    }
    #sidebar ul.components li.active > a {
      background: #ffffff !important;
      color: #8e1c19 !important;
      font-weight: 700;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    #sidebarCollapse {
      background: #b02522 !important;
      border: none !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    /* Content Page Container Background preserving auth_background */
    #content {
      background-image: url('{{ asset('assets/images/auth_background/background.png') }}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      min-height: 100vh;
      width: 100%;
      padding: 2.5rem 1.5rem;
    }

    /* Common Card Styling for Auth Subpages */
    .auth-page-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 28px;
      border: 1px solid rgba(176, 37, 34, 0.12);
      box-shadow: 0 15px 40px rgba(176, 37, 34, 0.08);
      padding: 2.5rem;
      width: 100%;
      max-width: 960px;
      margin: 0 auto;
      transition: all 0.3s ease;
    }

    .auth-page-header {
      font-size: 1.6rem;
      font-weight: 800;
      color: #8e1c19;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid rgba(176, 37, 34, 0.12);
      display: flex;
      align-items: center;
      gap: 10px;
    }
  </style>

  @yield('css')
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
      </div>
      <div class="p-4">
        <h1 class="mb-4">
          <a href="{{ route('index') }}" class="logo">
            <i class="fa fa-sitemap me-2"></i>{{ __('Family tree') }}
          </a>
        </h1>
        <ul class="list-unstyled components mb-5">
          <li class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
            <a href="{{ route('profile') }}">
              <span class="fa fa-home mr-3"></span> {{ __('Account') }}</a>
          </li>
          <li>
            <a href="{{ route('home', ['lineage_id' => Auth::user()->lineage_id, 'slug_gia_pha' => Auth::user()->lineage->slug]) }}">
              <span class="fa fa-map-o mr-3"></span> {{ __('Chart') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'clan_info' ? 'active' : '' }}">
            <a href="{{ route('clan_info') }}">
              <span class="fa fa-bar-chart mr-3"></span>
              {{ __('Family Tree Statistics') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'about.edit' ? 'active' : '' }}">
            <a href="{{ route('about.edit') }}">
              <span class="fa fa-pencil mr-3"></span>
              {{ __('Edit Family About') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'edit.family-landing-pages' ? 'active' : '' }}">
            <a href="{{ route('edit.family-landing-pages') }}">
              <span class="fa fa-window-maximize mr-3"></span>
              {{ __('Edit Home Page') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'library' ? 'active' : '' }}">
            <a href="{{ route('library') }}">
              <span class="fa fa-calendar mr-3"></span>
              {{ __('History and Events') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'documents' ? 'active' : '' }}">
            <a href="{{ route('documents') }}"><span class="fa fa-file-text-o mr-3"></span>
              {{ __('Documents and Texts') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'announcement' ? 'active' : '' }}">
            <a href="{{ route('announcement') }}"><span class="fa fa-bullhorn mr-3"></span>
              {{ __('Family Announcement') }}</a>
          </li>
          <li class="{{ Route::currentRouteName() == 'support_contact' ? 'active' : '' }}">
            <a href="{{ route('contacts') }}"><span class="fa fa-envelope-o mr-3"></span> {{ __('Contact') }}</a>
          </li>
        </ul>
      </div>
    </nav>
    <div id="adminmenu" class="side-menu"></div>
    @yield('content')
  </div>

  <script src="{{ asset('assets/js/auth/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/auth/popper.js') }}"></script>
  <script src="{{ asset('assets/js/auth/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/auth/main.js') }}"></script>

  @yield('js')
  @include('voyager::media.manager')
  @yield('javascript')
  @stack('javascript')
</body>

</html>
