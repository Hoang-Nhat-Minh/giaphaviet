@extends('screens.auth.layout')

@section('content')
  <style>
    .auth-page-card {
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

    .auth-page-header {
      font-size: 1.6rem;
      font-weight: 800;
      color: #8e1c19;
      margin-bottom: 1.75rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid rgba(176, 37, 34, 0.12);
      display: flex;
      align-items: center;
      gap: 10px;
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
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: #ffffff;
      color: #b02522;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
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
      font-size: 1rem;
      font-weight: 600;
      color: #1e293b;
    }
  </style>

  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <h2 class="auth-page-header">
        <i class="fa fa-bar-chart me-2"></i> {{ __('Family Tree Statistics') }}
      </h2>

      <div class="info-grid">
        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-users"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Total members') }}</div>
            <div class="info-value fs-5 fw-bold text-danger">{{ $clanInfo['totalMember'] }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-heartbeat"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Living members') }}</div>
            <div class="info-value text-success fs-5 fw-bold">{{ $clanInfo['countCs'] }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-calendar-times-o"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Deceased members') }}</div>
            <div class="info-value text-secondary fs-5 fw-bold">{{ $clanInfo['countDm'] }}</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-star"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Clan leader') }}</div>
            <div class="info-value">
              {{ !empty($clanInfo['headOfClan']) ? implode(', ', $clanInfo['headOfClan']) : __('No information available') }}
            </div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-sitemap"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Branch leader') }}</div>
            <div class="info-value">
              {{ !empty($clanInfo['branch_head']) ? implode(', ', $clanInfo['branch_head']) : __('No information available') }}
            </div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-mars"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Number of males') }}</div>
            <div class="info-value">{{ $clanInfo['male'] }} ({{ $clanInfo['maleRatio'] }}%)</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-venus"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Number of females') }}</div>
            <div class="info-value">{{ $clanInfo['female'] }} ({{ $clanInfo['femaleRatio'] }}%)</div>
          </div>
        </div>

        <div class="info-item-box">
          <div class="info-icon-box">
            <i class="fa fa-pie-chart"></i>
          </div>
          <div>
            <div class="info-label">{{ __('Gender Ratio') }}</div>
            <div class="info-value">{{ __('Male') }}: {{ $clanInfo['maleRatio'] }}% | {{ __('Female') }}: {{ $clanInfo['femaleRatio'] }}%</div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
