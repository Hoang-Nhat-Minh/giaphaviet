<!doctype html>
<html lang="{{ App::getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ Voyager::setting('site.title') }}</title>
  <link rel="icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  @yield('extra-css')
</head>

<style>
  body {
    background-image: url('{{ asset('assets/images/bg-body.png') }}');
    background-position: top;
    font-family: 'Be Vietnam Pro', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    color: #3d1a19;
  }

  .great-vibes-regular {
    font-family: "Great Vibes", cursive !important;
    font-weight: 600 !important;
    font-style: italic !important;
  }

  @media (max-width: 576px) {
    .bg-header {
      height: auto;
      width: 100%;
    }

    .header-nav {
      display: flex;
      flex-direction: row;
      margin-left: 10px;
      margin-right: 10px;
    }

    .header-nav img {
      width: 95%;
    }
  }

  @media (min-width: 992px) {
    .bg-header {
      height: 250px;
    }

    .header-nav {
      display: flex;
      flex-direction: row;
    }
  }

  .header {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
</style>

<body>
  @include('screens.elements.notification')
  <header>
    <style>
      #quay_lai {
        @media screen and (max-width: 576px) {
          width: 70px;
        }
      }
    </style>
    <div class="position-relative m-2" style="width:fit-content">
      <a href="{{ route('index') }}">
        <img
          src="{{ session('website_language') === 'en' ? asset('/storage/icon/menu/btn-return-en.png') : asset('/storage/icon/menu/btn-return.png') }}"
          alt="quaylai" id="quay_lai">
      </a>
    </div>
    <div class="header">
      <img class="bg-header" src="{{ asset('assets/images/bg-header.png') }}" alt="">

      <ul class="navbar-nav header-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('second.home') }}">
            <img
              src="{{ session('website_language') === 'en' ? asset('/storage/icon/menu/btn-home-en.png') : asset('/storage/icon/menu/btn-home.png') }}"
              alt="dentho">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="{{ route('page', ['branch_id' => auth()->user()->branch_id, 'slug_gia_pha' => auth()->user()->lineage->slug, 'slug_bai_viet' => 'gioi-thieu']) }}">
            <img
              src="{{ session('website_language') === 'en' ? asset('/storage/icon/menu/btn-Introduce-en.png') : asset('/storage/icon/menu/btn-introduce.png') }}"
              alt="phaky">
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link"
            href="{{ route('temple', ['branch_id' => auth()->user()->branch_id, 'slug_gia_pha' => auth()->user()->lineage->slug]) }}">
            <img
              src="{{ session('website_language') === 'en' ? asset('/storage/icon/menu/thuvienanh-en.png') : asset('/storage/icon/menu/thuvienanh.png') }}"
              alt="thuvienanh">
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link"
            href="{{ route('home', ['lineage_id' => Auth::user()->lineage_id, 'slug_gia_pha' => auth()->user()->lineage->slug]) }}">
            <img
              src="{{ session('website_language') === 'en' ? asset('assets/images/header/phado-en.png') : asset('assets/images/header/phado.png') }}"
              alt="phado">
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile') }}">
            <img
              src="{{ session('website_language') === 'en' ? asset('assets/images/header/caidat-en.png') : asset('assets/images/header/caidat.png') }}"
              alt="tocuoc">
          </a>
        </li>
      </ul>
    </div>
  </header>

  <main style="background-image: url('{{ asset('assets/images/bggiapha2.jpg') }}');padding-bottom:20px">
    @yield('main')
  </main>

  <footer style="margin-top: -20px;">
    <div style="display: flex; justify-content: center;">
      <img width="300px" src="{{ asset('assets/images/bggiaphaft.png') }}" alt="">
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  @yield('js')

  @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999">
      <div id="errorToast" class="toast text-bg-danger border-0" role="alert">
        <div class="d-flex">
          <div class="toast-body">
            {{ session('error') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded',function(){
        new bootstrap.Toast(document.getElementById('errorToast'),{
          delay:5000
        }).show();
      });
    </script>
  @endif
</body>

</html>
