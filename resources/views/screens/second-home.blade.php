@extends('screens.layouts.' . $template)

@section('extra-css')
  <link href="{{ asset('assets/css1/main.css') }}" rel="stylesheet">
  {{-- FANCYBOX --}}
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* Global Container */
    .second-home-container {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      color: #334155;
    }

    /* 1. Clean Section Title (Centering fix) */
    .section-title,
    .event-schedule-area-two .section-title {
      text-align: center !important;
      padding-left: 0 !important;
      margin-bottom: 2.5rem !important;
      border: none !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      justify-content: center !important;
      width: 100% !important;
    }

    .section-title::before,
    .section-title::after,
    .section-title h2::before,
    .event-schedule-area-two .section-title::before {
      display: none !important;
      content: none !important;
      border: none !important;
    }

    .section-title h2,
    .event-schedule-area-two .section-title .title-text h2 {
      font-family: "Great Vibes", cursive !important;
      font-size: 3.2rem !important;
      font-weight: 600 !important;
      font-style: italic !important;
      color: #8e1c19 !important;
      letter-spacing: 0.5px !important;
      margin: 0 !important;
      padding: 0 !important;
      border: none !important;
      position: relative !important;
      display: inline-block !important;
      text-align: center !important;
    }

    .section-title h2::after {
      content: "" !important;
      display: block !important;
      width: 44px !important;
      height: 3px !important;
      background: #b02522 !important;
      border-radius: 30px !important;
      margin: 10px auto 0 !important;
    }

    /* 2 & 3. Soft Floating Cards & Glassmorphic Whitespace */
    .content-card {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 28px;
      border: 1px solid rgba(176, 37, 34, 0.08);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      padding: 3rem 2.5rem;
      transition: all 0.35s ease;
    }

    .content-card:hover {
      box-shadow: 0 15px 35px rgba(176, 37, 34, 0.09);
    }

    .about-img-wrap {
      overflow: hidden;
      border-radius: 24px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      border: 3px solid #ffffff;
    }

    .about-img-wrap img {
      width: 100%;
      height: auto;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .about-img-wrap:hover img {
      transform: scale(1.03);
    }

    /* Typography & Line-height */
    .about-text-content {
      font-size: 1.05rem;
      line-height: 1.75;
      color: #334155;
      text-align: justify;
    }

    .about-text-content p {
      margin-bottom: 1.25rem;
    }

    /* Gallery Section Soft Cards */
    .gallery-card {
      position: relative;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
      border: 3px solid #ffffff;
      transition: all 0.35s ease;
      background: #ffffff;
    }

    .gallery-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 35px rgba(176, 37, 34, 0.12);
    }

    .gallery-card img {
      height: 270px;
      object-fit: cover;
      width: 100%;
      transition: transform 0.5s ease;
    }

    .gallery-card:hover img {
      transform: scale(1.05);
    }

    .gallery-overlay {
      position: absolute;
      inset: 0;
      background: rgba(142, 28, 25, 0.4);
      backdrop-filter: blur(2px);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .gallery-card:hover .gallery-overlay {
      opacity: 1;
    }

    .gallery-icon-btn {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: #ffffff;
      color: #b02522;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
      transform: scale(0.85);
      transition: transform 0.3s ease;
    }

    .gallery-card:hover .gallery-icon-btn {
      transform: scale(1);
    }

    /* 4. Events Table Redesign */
    .custom-table-card {
      background: rgba(255, 255, 255, 0.96);
      border-radius: 28px;
      overflow: hidden;
      border: 1px solid rgba(176, 37, 34, 0.08);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      padding: 0.5rem;
    }

    .custom-table-card table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin-bottom: 0;
    }

    .custom-table-card thead {
      background: #fbf2ed !important;
      color: #8e1c19 !important;
    }

    .custom-table-card th {
      padding: 16px 20px !important;
      font-weight: 700;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 2px solid rgba(176, 37, 34, 0.1) !important;
      color: #8e1c19 !important;
    }

    .custom-table-card tbody tr {
      border-bottom: 1px solid rgba(176, 37, 34, 0.06);
      transition: background-color 0.2s ease;
    }

    .custom-table-card tbody tr:last-child {
      border-bottom: none;
    }

    .custom-table-card tbody tr:hover {
      background-color: rgba(251, 242, 237, 0.5);
    }

    .custom-table-card td {
      padding: 18px 20px !important;
      vertical-align: middle !important;
      border: none !important;
    }

    .event-thumb {
      width: 70px;
      height: 70px;
      border-radius: 18px;
      object-fit: cover;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
      border: 2px solid #ffffff;
      display: block;
      margin: 0 auto;
    }

    .event-title-link {
      font-size: 1.05rem;
      font-weight: 700;
      color: #8e1c19;
      text-decoration: none;
      transition: color 0.2s ease;
      display: block;
      margin: 0;
      padding: 0;
    }

    .event-title-link:hover {
      color: #b02522;
      text-decoration: underline;
    }

    .event-meta-badge {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      background: #fbf2ed !important;
      color: #8e1c19 !important;
      font-weight: 600 !important;
      font-size: 0.825rem !important;
      padding: 4px 12px !important;
      border-radius: 20px !important;
      margin-top: 6px !important;
      margin-left: 0 !important;
    }

    /* Redesigned Outline "Xem" Button */
    .btn-view-event {
      background: #ffffff !important;
      color: #b02522 !important;
      border: 1.5px solid #b02522 !important;
      font-weight: 700;
      font-size: 0.875rem;
      padding: 7px 22px;
      border-radius: 25px;
      text-decoration: none !important;
      transition: all 0.25s ease;
      display: inline-block;
    }

    .btn-view-event:hover {
      background: #b02522 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 14px rgba(176, 37, 34, 0.25);
    }

    /* Contact Info Cards Soft Design */
    .contact-info-card {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 28px;
      border: 1px solid rgba(176, 37, 34, 0.08);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      padding: 2.25rem 1.75rem;
      text-align: center;
      height: 100%;
      transition: all 0.35s ease;
    }

    .contact-info-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 35px rgba(176, 37, 34, 0.1);
    }

    .contact-icon-bubble {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: #fbf2ed;
      color: #b02522;
      font-size: 1.4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.25rem;
      border: 1px solid rgba(176, 37, 34, 0.15);
    }

    .contact-info-card h3 {
      font-size: 1.15rem;
      font-weight: 700;
      color: #8e1c19;
      margin-bottom: 0.75rem;
    }

    .contact-text {
      color: #475569;
      font-size: 0.95rem;
      line-height: 1.65;
      white-space: pre-wrap;
      word-break: break-word;
      font-family: inherit;
    }
  </style>
@endsection

@section('main')
  <div class="second-home-container py-4">
    <!-- About Section -->
    <section id="about" class="about section py-4">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Family Clan Infomation') }}</h2>
      </div>
      <div class="container">
        <div class="content-card" data-aos="fade-up">
          <div class="row gy-4 align-items-center">
            <div class="col-lg-6 order-1 order-lg-2">
              <div class="about-img-wrap">
                @if (!empty($data->about_image))
                  <img src="{{ Voyager::image($data->about_image) }}" alt="about">
                @else
                  <div class="d-flex align-items-center justify-content-center bg-light text-muted p-5 rounded-4" style="height: 250px; border: 2px dashed rgba(176, 37, 34, 0.2);">
                    <span><i class="fa fa-picture-o me-2"></i> {{ __('This section has no data yet') }}</span>
                  </div>
                @endif
              </div>
            </div>
            <div class="col-lg-6 order-2 order-lg-1">
              <div class="about-text-content">
                @if (!empty($data->about) && trim(strip_tags($data->about)) != '')
                  {!! $data->about !!}
                @else
                  <div class="text-muted text-center py-4" style="font-style: italic;">
                    <i class="fa fa-info-circle me-1"></i> {{ __('This section has no data yet') }}
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section py-4">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Gallery') }}</h2>
      </div>
      <div class="container">
        <div class="row gy-4">
          @php
            $images = json_decode($data->gallery ?? '[]', true);
          @endphp
          @if (!empty($images) && is_array($images) && count($images) > 0)
            @foreach ($images as $image)
              <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="gallery-card">
                  <img src="{{ Voyager::image($image) }}" alt="gallery">
                  <a href="{{ Voyager::image($image) }}" data-fancybox="gallery" class="gallery-overlay">
                    <span class="gallery-icon-btn">
                      <i class="fa fa-search-plus"></i>
                    </span>
                  </a>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-12">
              <div class="alert text-center rounded-pill p-3 font-weight-bold" style="background:#fbf2ed; border: 1px solid rgba(176,37,34,0.2); color:#8e1c19;">
                <i class="fa fa-info-circle me-2"></i> {{ __('This section has no data yet') }}
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="portfolio section py-4">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('History and Events') }}</h2>
      </div>
      <div class="container" data-aos="fade-up">
        @if ($libaries->isEmpty())
          <div class="alert text-center rounded-pill p-3 font-weight-bold" style="background:#fbf2ed; border: 1px solid rgba(176,37,34,0.2); color:#8e1c19;">
            <i class="fa fa-info-circle me-2"></i> {{ __('This section has no data yet') }}
          </div>
        @else
          <div class="custom-table-card">
            <div class="table-responsive">
              <table class="table align-middle m-0">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 100px;">{{ __('Image') }}</th>
                    <th class="text-start" style="width: 30%;">{{ __('Information') }}</th>
                    <th class="text-start">{{ __('Short Description') }}</th>
                    <th class="text-center" style="width: 130px;">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($libaries as $library)
                    <tr>
                      <td class="text-center align-middle">
                        <img src="{{ Voyager::image($library->img) }}" alt="{{ $library->name }}" class="event-thumb" />
                      </td>
                      <td class="text-start align-middle">
                        <a href="{{ route('library.view', $library->id) }}" class="event-title-link">
                          {{ $library->name }}
                        </a>
                        <div class="p-0 m-0">
                          <span class="event-meta-badge">
                            <i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($library->datetime)->format('d-m-Y') }}
                          </span>
                        </div>
                      </td>
                      <td class="text-start align-middle">
                        <span class="text-secondary" style="font-size: 0.95rem; line-height: 1.65; display: inline-block;">{{ $library->des }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <a class="btn-view-event" href="{{ route('library.view', $library->id) }}">
                          {{ __('View') }}
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section py-4">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Contact') }}</h2>
      </div>
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-md-4">
            <div class="contact-info-card">
              <div class="contact-icon-bubble">
                <i class="fa fa-map-marker"></i>
              </div>
              <h3>{{ __('Address') }}</h3>
              <div class="contact-text">
                @if (!empty($data->address) && trim(strip_tags($data->address)) != '')
                  {!! strip_tags($data->address) !!}
                @else
                  <span class="text-muted" style="font-style: italic;">{{ __('This section has no data yet') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-info-card">
              <div class="contact-icon-bubble">
                <i class="fa fa-phone"></i>
              </div>
              <h3>{{ __('Phone number') }}</h3>
              <div class="contact-text">
                @if (!empty($data->telephone) && trim(strip_tags($data->telephone)) != '')
                  {!! strip_tags($data->telephone) !!}
                @else
                  <span class="text-muted" style="font-style: italic;">{{ __('This section has no data yet') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-info-card">
              <div class="contact-icon-bubble">
                <i class="fa fa-envelope"></i>
              </div>
              <h3>Email</h3>
              <div class="contact-text">
                @if (!empty($data->email) && trim(strip_tags($data->email)) != '')
                  {!! strip_tags($data->email) !!}
                @else
                  <span class="text-muted" style="font-style: italic;">{{ __('This section has no data yet') }}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  {{-- FANCYBOX --}}
  <script>
    Fancybox.bind("[data-fancybox]", {});
  </script>
@endsection
