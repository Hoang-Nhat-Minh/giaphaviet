@extends('screens.auth.layout')

@section('content')
  <style>
    .profile-card {
      width: 100%;
      max-width: 840px;
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 28px;
      border: 1px solid rgba(176, 37, 34, 0.12);
      box-shadow: 0 15px 45px rgba(176, 37, 34, 0.08);
      padding: 2.5rem;
      margin: 0 auto;
    }

    .profile-header {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      padding-bottom: 1.75rem;
      margin-bottom: 2rem;
      border-bottom: 1px solid rgba(176, 37, 34, 0.12);
    }

    .profile-avatar-bubble {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, #b02522 0%, #8e1c19 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      box-shadow: 0 6px 18px rgba(176, 37, 34, 0.3);
      flex-shrink: 0;
    }

    .profile-name {
      font-size: 1.6rem;
      font-weight: 800;
      color: #8e1c19;
      margin: 0;
      letter-spacing: -0.3px;
    }

    .profile-subtext {
      color: #64748b;
      font-size: 0.9rem;
      margin-top: 2px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.25rem;
    }

    @media (max-width: 768px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
      .info-item-box.span-full {
        grid-column: span 1 !important;
      }
    }

    .info-item-box {
      background: #fbf2ed;
      border: 1px solid rgba(176, 37, 34, 0.1);
      border-radius: 20px;
      padding: 1.25rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      transition: all 0.25s ease;
    }

    .info-item-box:hover {
      background: #ffffff;
      border-color: rgba(176, 37, 34, 0.25);
      box-shadow: 0 6px 20px rgba(176, 37, 34, 0.08);
      transform: translateY(-2px);
    }

    .info-icon-box {
      width: 44px;
      height: 44px;
      border-radius: 14px;
      background: #ffffff;
      color: #b02522;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      box-shadow: 0 3px 10px rgba(176, 37, 34, 0.1);
      flex-shrink: 0;
    }

    .info-label {
      font-size: 0.775rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #8e1c19;
      margin-bottom: 2px;
    }

    .info-value {
      font-size: 0.975rem;
      font-weight: 600;
      color: #1e293b;
    }

    .service-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 14px;
      border-radius: 20px;
      background: #b02522;
      color: #ffffff;
      font-size: 0.85rem;
      font-weight: 700;
      box-shadow: 0 3px 10px rgba(176, 37, 34, 0.25);
    }

    .lang-btn-pill {
      display: inline-flex;
      align-items: center;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 700;
      text-decoration: none !important;
      transition: all 0.2s ease;
    }

    .lang-btn-pill.active {
      background: #b02522;
      color: #ffffff !important;
      box-shadow: 0 3px 10px rgba(176, 37, 34, 0.25);
    }

    .lang-btn-pill.inactive {
      background: #ffffff;
      color: #64748b !important;
      border: 1px solid #cbd5e1;
    }

    .lang-btn-pill.inactive:hover {
      color: #b02522 !important;
      border-color: #b02522;
    }
  </style>

  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="profile-card">
      <div class="profile-header">
        <div class="profile-avatar-bubble">
          <i class="fa fa-user-circle"></i>
        </div>
        <div>
          <h2 class="profile-name">{{ Auth::user()->name }}</h2>
          <div class="profile-subtext">
            {{ __('Account Profile') }} • {{ Auth::user()->email }}
          </div>
        </div>
      </div>

      <div class="info-grid">
        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-user"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Username') }}</div>
            <div class="info-value">{{ Auth::user()->name }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-phone"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Phone number') }}</div>
            <div class="info-value">{{ Auth::user()->phone ?? 'Chưa cập nhật' }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-envelope"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Email') }}</div>
            <div class="info-value">{{ Auth::user()->email }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-map-marker"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Address') }}</div>
            <div class="info-value">{{ Auth::user()->location ?? 'Chưa cập nhật' }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-calendar-check-o"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Join date') }}</div>
            <div class="info-value">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-refresh"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Renewal date') }}</div>
            <div class="info-value">{{ Auth::user()->ngay_gia_han ? \Carbon\Carbon::parse(Auth::user()->ngay_gia_han)->format('d/m/Y') : 'Chưa có' }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-calendar-times-o"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Expiration date') }}</div>
            <div class="info-value">
              {{ Auth::user()->so_ngay_han && Auth::user()->ngay_gia_han ? \Carbon\Carbon::parse(Auth::user()->ngay_gia_han)->addDays(Auth::user()->so_ngay_han)->format('d/m/Y') : 'Chưa có' }}
            </div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-shield"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Service package') }}</div>
            <div class="info-value">
              @php
                $service = auth()->user()->loai_dich_vu;
                $service_name = App\Service::where('id', $service)->first();
              @endphp
              @if ($service_name)
                <span class="service-badge">{{ $service_name->title }}</span>
              @else
                <span class="badge bg-secondary">Chưa đăng ký gói</span>
              @endif
            </div>
          </div>
        </div>

        <div class="info-item-box span-full" style="grid-column: span 2; background: linear-gradient(135deg, #fffaf7 0%, #fbf2ed 100%); border: 1.5px solid rgba(176, 37, 34, 0.2);">
          <div class="info-icon-box" style="background: #b02522; color: #ffffff;">
            <i class="fa fa-file-pdf-o"></i>
          </div>
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 w-100">
            <div>
              <div class="info-label" style="color: #b02522;">{{ __('Xuất Cây Gia Phả (PDF In Ấn)') }}</div>
              <div class="info-value" style="font-size: 0.875rem; color: #64748b;">
                {{ __('Xuất bản file PDF Vector độ phân giải cao để mang đi in khổ lớn (A0, A1, A2...)') }}
              </div>
            </div>
            <a href="{{ route('export.pdf.preview') }}" target="_blank" class="lang-btn-pill active" style="background: #b02522; border: none; padding: 8px 20px; font-size: 0.9rem; white-space: nowrap;">
              <i class="fa fa-print me-1"></i> {{ __('Xuất file PDF') }}
            </a>
          </div>
        </div>

        <div class="info-item-box span-full" style="grid-column: span 2;">
          <div class="info-icon-box">
            <i class="fa fa-globe"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Language') }}</div>
            <div class="info-value d-flex align-items-center gap-2 mt-1">
              <a href="{{ route('change-lang', ['vi']) }}"
                class="lang-btn-pill {{ App::getLocale() == 'vi' ? 'active' : 'inactive' }}">
                <i class="fa fa-language me-1"></i> {{ __('Vietnamese') }}
              </a>
              <a href="{{ route('change-lang', ['en']) }}"
                class="lang-btn-pill {{ App::getLocale() == 'en' ? 'active' : 'inactive' }}">
                <i class="fa fa-globe me-1"></i> {{ __('English') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
