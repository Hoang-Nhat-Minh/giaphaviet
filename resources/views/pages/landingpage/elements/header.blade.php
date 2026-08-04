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
        position: relative !important;
        z-index: 999999 !important;
    }

    /* Desktop Styles */
    @media (min-width: 992px) {
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

        .wsmenu-list>li {
            display: flex !important;
            align-items: center !important;
            float: none !important;
        }

        .wsmenu-list>li>a {
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

        .wsmenu-list>li>a:hover {
            color: #b02522 !important;
            background: rgba(176, 37, 34, 0.08) !important;
        }

        .wsmenu>.wsmenu-list>li>a .wsarrow {
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

        .wsmenu>.wsmenu-list>li>a .wsarrow:after {
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
            border-radius: 20px !important;
            box-shadow: 0 15px 35px rgba(176, 37, 34, 0.12) !important;
            border: 1px solid rgba(176, 37, 34, 0.12) !important;
            padding: 12px !important;
            background: #ffffff !important;
        }

        .wsmegamenu .link-list li a {
            padding: 10px 18px !important;
            border-radius: 15px !important;
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

        .mobile-dropdown-icon {
            display: none !important;
        }
    }

    /* Mobile & Tablet Styles (< 992px) */
    @media (max-width: 991.98px) {
        .wsmenucontainer {
            overflow: visible !important;
        }

        .mobile-dropdown-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 13px !important;
            color: #b02522 !important;
            transition: transform 0.3s ease !important;
            margin-left: auto !important;
        }

        .wsmenu-list>li.has-dropdown.open>a .mobile-dropdown-icon {
            transform: rotate(180deg) !important;
        }

        .wsarrow,
        .wsmenu-click {
            display: none !important;
        }

        .wsactive .wsmenucontainer {
            margin-left: 0 !important;
            transform: none !important;
        }

        .wsmobileheader {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            position: relative !important;
            height: 65px !important;
            padding: 0 15px !important;
            background: rgba(251, 242, 237, 0.98) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(176, 37, 34, 0.12);
            box-shadow: 0 2px 10px rgba(176, 37, 34, 0.08) !important;
            z-index: 999999 !important;
        }

        #wsnavtoggle {
            position: absolute !important;
            left: 10px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            margin: 0 !important;
            float: none !important;
            z-index: 10;
        }

        .wsmobileheader .smllogo {
            position: absolute !important;
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, -50%) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            float: none !important;
            z-index: 5;
        }

        .wsmobileheader .smllogo img {
            max-height: 42px !important;
            object-fit: contain;
        }

        .callusbtn {
            position: absolute !important;
            right: 15px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            float: none !important;
            margin: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
            background: rgba(176, 37, 34, 0.1) !important;
            color: #b02522 !important;
            border-radius: 50% !important;
            font-size: 16px !important;
            text-decoration: none !important;
            z-index: 10;
        }

        .callusbtn:hover {
            background: #b02522 !important;
            color: #ffffff !important;
        }

        /* Mobile drawer slide styling */
        .wsmenu {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100vh !important;
            pointer-events: none;
            background: transparent !important;
            z-index: 999999 !important;
        }

        .wsactive .wsmenu {
            pointer-events: auto !important;
            visibility: visible !important;
        }

        .wsmenu>.wsmenu-list {
            position: fixed !important;
            top: 0 !important;
            left: -320px !important;
            width: 290px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            background: #ffffff !important;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.25) !important;
            padding: 20px 12px 30px 12px !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch !important;
            transition: left 0.3s ease-in-out !important;
            z-index: 1000000 !important;
        }

        .wsactive .wsmenu>.wsmenu-list {
            left: 0 !important;
            margin-left: 0 !important;
        }

        .overlapblackbg {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            background: rgba(0, 0, 0, 0.5) !important;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out !important;
            z-index: 999998 !important;
        }

        .wsactive .overlapblackbg {
            opacity: 1 !important;
            visibility: visible !important;
        }

        .wsmenu-list>li {
            width: 100% !important;
            position: relative !important;
            margin-bottom: 4px !important;
        }

        .wsmenu-list>li>a {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 12px 16px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            color: #3d1a19 !important;
            border-radius: 12px !important;
            background: transparent !important;
            border-bottom: 1px solid #f2e6e1 !important;
        }

        .wsmenu-list>li.has-dropdown>a {
            cursor: pointer !important;
        }

        .wsmenu-list>li>a:hover,
        .wsmenu-list>li>a:active {
            color: #b02522 !important;
            background: #fbf2ed !important;
        }

        /* Mobile submenus */
        .wsmegamenu.dropdown-custom {
            position: static !important;
            width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            background: #fdfaf8 !important;
            border-radius: 12px !important;
            padding: 6px 10px !important;
            margin-top: 6px !important;
            display: none;
        }

        .wsmegamenu .link-list {
            padding: 0 !important;
            margin: 0 !important;
        }

        .wsmegamenu .link-list li a {
            padding: 10px 14px !important;
            font-size: 14px !important;
            color: #5c3534 !important;
            border-radius: 8px !important;
            display: flex !important;
            align-items: center !important;
        }

        .wsmegamenu .link-list li a:hover {
            background: #f5e4dc !important;
            color: #b02522 !important;
        }

        /* Action buttons on mobile drawer */
        .wsmenu-list .header-phone-btn {
            width: 100% !important;
            justify-content: center !important;
            margin-top: 8px !important;
        }

        .wsmenu-list .lang-switcher {
            width: 100% !important;
            justify-content: center !important;
            margin-top: 8px !important;
        }

        .wsmenu-list .btn-user-account {
            width: 100% !important;
            justify-content: space-between !important;
            margin-top: 12px !important;
            background: #b02522 !important;
            color: #ffffff !important;
            border-radius: 30px !important;
            padding: 10px 20px !important;
            border-bottom: none !important;
            box-shadow: 0 4px 14px rgba(176, 37, 34, 0.25) !important;
        }

        .wsmenu-list .btn-user-account,
        .wsmenu-list .btn-user-account span,
        .wsmenu-list .btn-user-account i,
        .wsmenu-list .btn-user-account .menu-title-text,
        .wsmenu-list .btn-user-account .mobile-dropdown-icon {
            color: #ffffff !important;
        }
    }

    /* Shared Action Elements */
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

    .lang-btn:hover,
    .lang-btn.active {
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
            <a href="{{ route('index') }}" class="smllogo">
                <img src="{{ Voyager::image(setting('site.logo')) }}" alt="mobile-logo" />
            </a>
            @if (Voyager::setting('site.phone'))
                <a href="tel:{{ Voyager::setting('site.phone') }}" class="callusbtn"><i
                        class="fas fa-phone-alt"></i></a>
            @endif
        </div>

        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">
                <div class="desktoplogo">
                    <a href="{{ route('index') }}">
                        <img src="{{ Voyager::image(setting('site.logo')) }}" alt="header-logo">
                    </a>
                </div>

                <nav class="wsmenu clearfix blue-header">
                    <ul class="wsmenu-list">
                        @foreach ($main_menu as $item)
                            @if (count($item->children) > 0)
                                <li aria-haspopup="true" class="has-dropdown">
                                    <a href="{{ asset($item->url) }}">
                                        <span class="menu-title-text">{{ $item->translate()->title }}</span>
                                        <span class="wsarrow"></span>
                                        <i class="fas fa-chevron-down mobile-dropdown-icon"></i>
                                    </a>
                                    <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <ul class="col-12 link-list">
                                                    @foreach ($item->children as $child)
                                                        <li><a
                                                                href="{{ asset($child->url) }}">{{ $child->translate()->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="nl-simple">
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
                                <a href="{{ route('change-lang', ['vi']) }}"
                                    class="lang-btn {{ App::currentLocale() == 'vi' ? 'active' : '' }}"
                                    title="Tiếng Việt">
                                    <i class="fi fi-vn"></i> VI
                                </a>
                                <a href="{{ route('change-lang', ['en']) }}"
                                    class="lang-btn {{ App::currentLocale() == 'en' ? 'active' : '' }}"
                                    title="English">
                                    <i class="fi fi-us"></i> EN
                                </a>
                            </div>
                        </li>

                        @if (Auth::check())
                            <li aria-haspopup="true" class="has-dropdown">
                                <a href="#" class="btn-user-account">
                                    <span class="menu-title-text"><i class="fas fa-user-circle mr-2"></i> {{ __('Account') }}</span>
                                    <span class="wsarrow"></span>
                                    <i class="fas fa-chevron-down mobile-dropdown-icon"></i>
                                </a>
                                <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <ul class="col-12 link-list">
                                                <li>
                                                    <a href="{{ route('login') }}">
                                                        <i class="fas fa-sitemap mr-2 text-danger"></i>
                                                        {{ __('Family Tree Management') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}">
                                                        <i class="fas fa-sign-out-alt mr-2 text-muted"></i>
                                                        {{ __('Logout') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li aria-haspopup="true" class="has-dropdown">
                                <a href="#" class="btn-user-account">
                                    <span class="menu-title-text"><i class="fas fa-user mr-2"></i> {{ __('Account') }}</span>
                                    <span class="wsarrow"></span>
                                    <i class="fas fa-chevron-down mobile-dropdown-icon"></i>
                                </a>
                                <div class="wsmegamenu clearfix halfmenu dropdown-custom">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <ul class="col-12 link-list">
                                                <li>
                                                    <a href="{{ route('login') }}">
                                                        <i class="fas fa-sign-in-alt mr-2 text-danger"></i>
                                                        {{ __('Login') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('register') }}">
                                                        <i class="fas fa-user-plus mr-2 text-dark"></i>
                                                        {{ __('Register') }}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof jQuery !== 'undefined') {
            jQuery(document).on('click', '.wsmenu-list > li.has-dropdown > a', function(e) {
                if (jQuery(window).width() < 992) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $parentLi = jQuery(this).closest('li');
                    var $dropdown = $parentLi.find('> .wsmegamenu, > .sub-menu');

                    $parentLi.siblings('li.has-dropdown').removeClass('open').find('> .wsmegamenu, > .sub-menu').slideUp(200);

                    $parentLi.toggleClass('open');
                    $dropdown.stop(true, true).slideToggle(200);
                }
            });
        }
    });
</script>
