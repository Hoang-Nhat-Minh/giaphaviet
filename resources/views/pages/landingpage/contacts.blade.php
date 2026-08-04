@extends('pages.landingpage.layout')

@section('content')
  @include('pages.landingpage.elements.header')

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    .contacts-page-wrapper {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      color: #334155;
      background-color: #fbf2ed;
    }

    .contact-card-box {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 28px;
      border: 1px solid rgba(176, 37, 34, 0.12);
      box-shadow: 0 15px 45px rgba(176, 37, 34, 0.08);
      padding: 2.5rem;
    }

    .contact-form-title {
      font-size: 1.5rem;
      font-weight: 800;
      color: #8e1c19;
      margin-bottom: 1.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid rgba(176, 37, 34, 0.1);
    }

    .form-custom-input {
      border-radius: 20px;
      padding: 12px 18px;
      border: 1px solid rgba(176, 37, 34, 0.18);
      font-size: 0.95rem;
      transition: all 0.25s ease;
      background: #ffffff;
      width: 100%;
    }

    .form-custom-input:focus {
      border-color: #b02522;
      box-shadow: 0 0 0 4px rgba(176, 37, 34, 0.12);
      outline: none;
    }

    .btn-submit-contact {
      background: linear-gradient(135deg, #b02522 0%, #8e1c19 100%);
      color: #ffffff !important;
      font-weight: 700;
      font-size: 0.95rem;
      padding: 12px 36px;
      border-radius: 30px;
      border: none;
      box-shadow: 0 6px 18px rgba(176, 37, 34, 0.3);
      transition: all 0.3s ease;
    }

    .btn-submit-contact:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(176, 37, 34, 0.4);
    }

    .side-info-card {
      background: rgba(255, 255, 255, 0.96);
      border-radius: 24px;
      border: 1px solid rgba(176, 37, 34, 0.1);
      box-shadow: 0 10px 30px rgba(176, 37, 34, 0.06);
      padding: 1.5rem;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: flex-start;
      gap: 1.25rem;
      transition: all 0.3s ease;
    }

    .side-info-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 14px 35px rgba(176, 37, 34, 0.12);
    }

    .side-info-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #fbf2ed;
      color: #b02522;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      box-shadow: 0 4px 12px rgba(176, 37, 34, 0.12);
      flex-shrink: 0;
      border: 1px solid rgba(176, 37, 34, 0.15);
    }

    .side-info-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: #8e1c19;
      margin-bottom: 0.35rem;
    }

    .side-info-text {
      color: #475569;
      font-size: 0.925rem;
      line-height: 1.6;
    }

    .social-link-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #fbf2ed;
      color: #8e1c19 !important;
      font-weight: 700;
      font-size: 0.85rem;
      padding: 6px 16px;
      border-radius: 20px;
      text-decoration: none !important;
      margin-right: 6px;
      margin-top: 6px;
      border: 1px solid rgba(176, 37, 34, 0.15);
      transition: all 0.2s ease;
    }

    .social-link-pill:hover {
      background: #b02522;
      color: #ffffff !important;
    }
  </style>

  <div class="inner-page-wrapper">
    <section id="contacts-page" class="page-hero-section division"
      style="background-image: url({{ Voyager::image($contacts_page->banner_image) }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="hero-txt text-center white-color">
              <h3 class="h3-xl">{{ $contacts_page->translate()->banner_text }}</h3>
              <p>{{ $contacts_page->translate()->banner_subtext }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="breadcrumb" class="division">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="primary-color">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $contacts_page->translate()->banner_text }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-5 contacts-page-wrapper">
      <div class="container py-2">
        <div class="row gy-4">
          <!-- Left: Contact Form -->
          <div class="col-lg-7 col-md-12">
            <div class="contact-card-box">
              <h4 class="contact-form-title">
                <i class="fa fa-paper-plane me-2"></i>{{ __('Gửi lời nhắn cho chúng tôi') }}
              </h4>

              <form class="row g-3" action="{{ route('contacts.save') }}" method="post">
                @csrf

                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark small mb-1">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-custom-input @error('name') is-invalid @enderror"
                    placeholder="{{ $errors->first('name') ?? __('Full Name') }}" value="{{ old('name') }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label font-weight-bold text-dark small mb-1">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-custom-input @error('email') is-invalid @enderror"
                    placeholder="{{ $errors->first('email') ?? 'Email' }}" value="{{ old('email') }}">
                </div>

                <div class="col-12">
                  <label class="form-label font-weight-bold text-dark small mb-1">{{ __('Title') }} <span class="text-danger">*</span></label>
                  <input type="text" name="title" class="form-custom-input @error('title') is-invalid @enderror"
                    placeholder="{{ $errors->first('title') ?? __('Title') }}" value="{{ old('title') }}">
                </div>

                <div class="col-12">
                  <label class="form-label font-weight-bold text-dark small mb-1">{{ __('Content') }} <span class="text-danger">*</span></label>
                  <textarea class="form-custom-input @error('content') is-invalid @enderror" name="content" rows="5"
                    placeholder="{{ $errors->first('content') ?? __('Content') }}" style="border-radius: 20px;">{{ old('content') }}</textarea>
                </div>

                <div class="col-12 text-end pt-2">
                  <button type="submit" class="btn-submit-contact">
                    <i class="fa fa-paper-plane me-2"></i>{{ __('Submit') }}
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Right: Contact Details -->
          <div class="col-lg-5 col-md-12">
            <div class="side-info-card">
              <div class="side-info-icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <div>
                <h5 class="side-info-title">{{ __('Address') }}</h5>
                <div class="side-info-text">
                  {{ session('website_language') === 'en' ? Voyager::setting('site-en.location') : Voyager::setting('site.location') }}
                </div>
              </div>
            </div>

            <div class="side-info-card">
              <div class="side-info-icon">
                <i class="fa fa-phone"></i>
              </div>
              <div>
                <h5 class="side-info-title">{{ __('Contact Information') }}</h5>
                <div class="side-info-text">
                  <div><strong>Phone:</strong> {{ Voyager::setting('site.phone') }}</div>
                  <div><strong>Email:</strong> {{ Voyager::setting('site.email') }}</div>
                </div>
              </div>
            </div>

            <div class="side-info-card">
              <div class="side-info-icon">
                <i class="fa fa-share-alt"></i>
              </div>
              <div>
                <h5 class="side-info-title">{{ __('Social Media') }}</h5>
                <div class="mt-2">
                  <a href="#" class="social-link-pill"><i class="fa fa-facebook"></i> Facebook</a>
                  <a href="#" class="social-link-pill"><i class="fa fa-youtube-play"></i> Youtube</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  {{-- Alert --}}
  <style>
    .truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .alert_custom {
      position: fixed;
      pointer-events: none;
      width: 100%;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 9999999999;
    }

    /* list */
    .alert_custom .list {
      display: flex;
      flex-direction: column;
      margin: 1rem;
      width: 100%;
      max-width: 400px;
      float: right;
    }

    /* item */
    .alert_custom .list .item {
      --line-height: 4px;
      position: relative;
      display: flex;
      align-items: center;
      padding: .5rem;
      color: #fff;
      border-radius: 0.25rem;
      overflow: hidden;
      padding-bottom: calc(.5rem + var(--line-height))
    }

    .alert_custom .list .item.success {
      background: #16A34A;
    }

    .alert_custom .list .item.error {
      background: #EAB308;
    }

    .alert_custom .list .item::after {
      content: "";
      position: absolute;
      width: 0;
      height: var(--line-height);
      background: #fff;
      bottom: 0;
      left: 0;
      animation: line 3s linear;
    }

    /* icon */
    .alert_custom .list .icon {
      flex: none;
      display: block;
      width: 40px;
      height: 40px;
    }

    .alert_custom .list .icon svg {
      width: 100%;
      height: 100%;
    }

    /* title */
    .alert_custom .list .title {
      min-width: 0;
      flex-grow: 1;
      margin-left: .5rem;
    }

    .alert_custom .list .title h6 {
      width: 100%;
      font-family: Arial, Helvetica, sans-serif !important;
      font-size: 14px !important;
      color: inherit !important;
      font-weight: bold;
      line-height: 1.5;
      margin: 0;
    }

    .alert_custom .list .title p {
      width: 100%;
      font-family: Arial, Helvetica, sans-serif !important;
      font-size: 12px !important;
      color: inherit !important;
      margin: 0rem !important;
      line-height: 1.5;
    }

    /* transiton */
    .transition_all {
      transition: all .3s ease-in-out;
    }

    .enter_start {
      transform: scale(0);
      opacity: 0;
    }

    .enter_end {
      transform: scale(1);
      opacity: 1;
    }

    .leave_start {
      transform: translateX(0);
      opacity: 1;
    }

    .leave_end {
      transform: translateX(100%);
      opacity: 0;
    }

    @keyframes line {
      from {
        width: 0;
      }

      to {
        width: 100%;
      }
    }
  </style>

  <div x-data="alert" class="alert_custom">
    <div class="list">
      <template x-for="item in list" :key="item.id">
        <div class="item" x-show="item.show" x-transition:enter="transition_all"
          x-transition:enter-start="enter_start" x-transition:enter-end="enter_end"
          x-transition:leave="transition_all" x-transition:leave-start="leave_start"
          x-transition:leave-end="leave_end" :class="item.type">
          <span class="icon">
            <template x-if="item.type == 'success'">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                style="fill: currentColor">
                <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
              </svg>
            </template>
            <template x-if="item.type == 'error'">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                style="fill: currentColor">
                <path
                  d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z">
                </path>
                <path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path>
              </svg>
            </template>
          </span>
          <div class="title">
            <h6 class="truncate" x-text="item.title"></h6>
            <p x-text="item.body"></p>
          </div>
        </div>
      </template>
    </div>
  </div>
@endsection

@section('extra-js')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('alert', () => ({
        index: 0,
        list: [],
        init() {
          let alert = JSON.parse(`@json(session()->get('alert'))`)
          if (alert)
            this.addAlert(alert)
        },
        addAlert(alert) {
          this.list = [...JSON.parse(JSON.stringify(this.list)), {
            id: ++this.index,
            type: alert.type,
            title: alert.title,
            body: alert.body,
            show: false
          }]

          this.$nextTick(() => {
            this.list[this.index - 1].show = true
          })

          setTimeout(() => {
            this.list[this.index - 1].show = false
          }, 3000);
        }
      }))
    })
  </script>
@endsection
