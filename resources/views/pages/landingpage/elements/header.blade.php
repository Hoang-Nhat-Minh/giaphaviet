@php
  $main_menu = menu('home', '_json');
@endphp

<style>
  #header.header.custom-header-style {
    box-shadow: 0 4px 20px rgba(176, 37, 34, 0.08);
    background: rgba(251, 242, 237, 0.96) !important;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(176, 37, 34, 0.12);
    transition: all 0.3s ease;
  }

  .wsmainwp {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    height: 75px !important;
  }

  .desktoplogo {
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
  }

  .desktoplogo img {
    max-height: 52px;
    object-fit: contain;
    transition: transform 0.3s ease;
  }
  .desktoplogo a:hover img {
    transform: scale(1.03);
  }

  .wsmenu {
    display: flex !important;
    align-items: center !important;
  }

  .wsmenu-list {
    display: flex !important;
    align-items: center !important;
    gap: 8px;
    margin: 0 !important;
    padding: 0 !important;
  }

  .wsmenu-list > li {
    display: flex !important;
    align-items: center !important;
    float: none !important;
  }

  .wsmenu-list > li > a {
    font-weight: 600;
    font-size: 14.5px;
    color: #3d1a19 !important;
    padding: 8px 16px !important;
    height: 42px !important;
    border-radius: 30px !important;
    transition: all 0.25s ease;
    display: inline-flex !important;
    align-items: center !important;
    white-space: nowrap !important;
  }

  .wsmenu-list > li > a:hover {
    color: #b02522 !important;
    background: rgba(176, 37, 34, 0.08) !important;
  }

  .wsmenu > .wsmenu-list > li > a .wsarrow {
    display: inline-flex !important;
    align-items: center !important;
    margin-left: 6px !important;
    position: relative !important;
    top: 0 !important;
    right: 0 !important;
    left: 0 !important;
    height: auto !important;
    width: auto !important;
  }

  .wsmenu > .wsmenu-list > li > a .wsarrow:after {
    position: relative !important;
    top: 1px !important;
    right: 0 !important;
    left: 0 !important;
    margin: 0 0 0 4px !important;
    float: none !important;
    display: inline-block !important;
    border-left: 4px solid transparent !important;
    border-right: 4px solid transparent !important;
    border-top: 5px solid currentColor !important;
    content: "" !important;
    vertical-align: middle !important;
  }

  .wsmegamenu.dropdown-custom {
    border-radius: 25px !important;
    box-shadow: 0 15px 35px rgba(176, 37, 34, 0.12) !important;
    border: 1px solid rgba(176, 37, 34, 0.12) !important;
    padding: 16px !important;
    background: #ffffff !important;
  }

  .wsmegamenu .link-list li a {
    padding: 12px 22px !important;
    border-radius: 25px !important;
    font-weight: 500 !important;
    color: #3d1a19 !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
  }

  .wsmegamenu .link-list li a:hover {
    background: #fbf2ed !important;
    color: #b02522 !important;
    transform: translateX(4px);
  }

  .header-phone-btn {
    background: rgba(176, 37, 34, 0.07) !important;
    border: none !important;
    color: #b02522 !important;
    font-weight: 700 !important;
    font-size: 13.5px !important;
    padding: 0 20px !important;
    height: 42px !important;
    border-radius: 30px !important;
    transition: all 0.25s ease;
    display: inline-flex !important;
    align-items: center !important;
    white-space: nowrap !important;
  }

  .header-phone-btn:hover {
    background: #b02522 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 14px rgba(176, 37, 34, 0.25);
  }

  .lang-switcher {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(176, 37, 34, 0.07);
    padding: 3px 5px;
    border-radius: 30px;
    height: 42px;
  }

  .lang-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0 14px;
    height: 36px;
    border-radius: 30px;
    font-size: 12.5px;
    font-weight: 700;
    color: #5c3534 !important;
    text-decoration: none !important;
    transition: all 0.2s ease;
  }

  .lang-btn:hover, .lang-btn.active {
    background: #ffffff;
    color: #b02522 !important;
    box-shadow: 0 2px 8px rgba(176, 37, 34, 0.15);
  }

  .btn-user-account {
    background: #b02522 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    padding: 0 22px !important;
    height: 42px !important;
    border-radius: 30px !important;
    box-shadow: 0 4px 14px rgba(176, 37, 34, 0.25);
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    white-space: nowrap !important;
  }

  .btn-user-account i,
  .btn-user-account span,
  .btn-user-account .wsarrow:after {
    color: #ffffff !important;
    border-top-color: #ffffff !important;
  }

  .btn-user-account:hover {
    background: #8e1c19 !important;
    color: #ffffff !important;
    box-shadow: 0 6px 18px rgba(176, 37, 34, 0.4) !important;
    transform: translateY(-1px);
  }
</style>

<header id="header" class="header white-menu navbar-dark custom-header-style">
  <div class="header-wrapper">
    <div class="wsmobileheader clearfix">
      <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
      <span class="smllogo smllogo-black">
        <img src="{{ Voyager::image(setting('site.logo')) }}" style="height:45px" alt="mobile-logo" />
      </span>
      <span class="smllogo smllogo-white">
        <img src="{{ Voyager::image(setting('site.logo')) }}" style="height:45px" alt="mobile-logo" />
      </span>
      @if (Voyager::setting('site.phone'))
        <a href="tel:{{ Voyager::setting('site.phone') }}" class="callusbtn"><i class="fas fa-phone-alt"></i></a>
      @endif
    </div>

    <div class="wsmainfull menu clearfix">
      <div class="wsmainwp clearfix">
        <div class="desktoplogo">
          <a href="{{ route('index') }}" class="logo-black">
            <img src="{{ Voyager::image(setting('site.logo')) }}" alt="header-logo">
          </a>
        </div>
        <div class="desktoplogo">
          <a href="{{ route('index') }}" class="logo-white">
            <img src="{{ Voyager::image(setting('site.logo')) }}" alt="header-logo">
          </a>
        </div>

        <nav class="wsmenu clearfix blue-header">
          <ul class="wsmenu-list">
            @foreach ($main_menu as $item)
              @if (count($item->children) > 0)
                <li aria-haspopup="true">
                  <a href="{{ asset($item->url) }}">{{ $item->translate()->title }} <span class="wsarrow"></span></a>
                  <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                    <div class="container-fluid">
                      <div class="row">
                        <ul class="col-12 link-list">
                          @foreach ($item->children as $child)
                            <li><a href="{{ asset($child->url) }}">{{ $child->translate()->title }}</a></li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              @else
                <li class="nl-simple" aria-haspopup="true">
                  <a href="{{ asset($item->url) }}">{{ $item->translate()->title }}</a>
                </li>
              @endif
            @endforeach

            @if (Voyager::setting('site.phone'))
              <li class="nl-simple">
                <a href="tel:{{ Voyager::setting('site.phone') }}" class="header-phone-btn">
                  <i class="fas fa-phone-alt mr-2"></i> {{ Voyager::setting('site.phone') }}
                </a>
              </li>
            @endif

            <li class="nl-simple">
              <div class="lang-switcher">
                <a href="{{ route('change-lang', ['vi']) }}" class="lang-btn {{ App::currentLocale() == 'vi' ? 'active' : '' }}" title="Tiếng Việt">
                  <i class="fi fi-vn"></i> VI
                </a>
                <a href="{{ route('change-lang', ['en']) }}" class="lang-btn {{ App::currentLocale() == 'en' ? 'active' : '' }}" title="English">
                  <i class="fi fi-us"></i> EN
                </a>
              </div>
            </li>

            @if (Auth::check())
              <li aria-haspopup="true">
                <a href="#" class="btn-user-account">
                  <i class="fas fa-user-circle mr-2"></i> {{ __('Account') }} <span class="wsarrow"></span>
                </a>
                <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                  <div class="container-fluid">
                    <div class="row">
                      <ul class="col-12 link-list">
                        <li>
                          <a href="{{ route('login') }}">
                            <i class="fas fa-sitemap mr-2 text-danger"></i> {{ __('Family Tree Management') }}
                          </a>
                        </li>
                        <li>
                          <a href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt mr-2 text-muted"></i> {{ __('Logout') }}
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @else
              <li aria-haspopup="true">
                <a href="#" class="btn-user-account">
                  <i class="fas fa-user mr-2"></i> {{ __('Account') }} <span class="wsarrow"></span>
                </a>
                <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                  <div class="container-fluid">
                    <div class="row">
                      <ul class="col-12 link-list">
                        <li>
                          <a href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt mr-2 text-danger"></i> {{ __('Login') }}
                          </a>
                        </li>
                        <li>
                          <a href="{{ route('register') }}">
                            <i class="fas fa-user-plus mr-2 text-dark"></i> {{ __('Register') }}
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
