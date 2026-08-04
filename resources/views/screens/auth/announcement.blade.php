@extends('screens.auth.layout')

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="auth-page-header border-0 m-0 p-0">
          <i class="fa fa-bullhorn me-2"></i> {{ __('Family Announcement') }}
        </h2>
        <a class="btn btn-danger px-4 py-2 rounded-pill font-weight-bold" href="{{ route('announcement.add') }}" style="background:#b02522; border:none; box-shadow: 0 4px 12px rgba(176, 37, 34, 0.3);">
          <i class="fa fa-plus me-1"></i> {{ __('Tạo thông báo mới') }}
        </a>
      </div>

      @if ($anouncements->isEmpty())
        <div class="alert text-center rounded-pill p-3 font-weight-bold" style="background:#fbf2ed; border: 1px solid rgba(176,37,34,0.2); color:#8e1c19;">
          <i class="fa fa-info-circle me-2"></i> Bạn chưa có thông báo nào
        </div>
      @else
        <div class="d-flex flex-column gap-3">
          @foreach ($anouncements as $anouncement)
            @php
              $isUpcoming = \Carbon\Carbon::parse($anouncement->datetime)->gt(\Carbon\Carbon::now());
            @endphp
            <div class="p-3 bg-white border rounded-4 shadow-sm d-flex justify-content-between align-items-center transition-all hover-lift">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width: 48px; height: 48px; background: {{ $isUpcoming ? '#e0f2fe' : '#dcfce7' }}; color: {{ $isUpcoming ? '#0284c7' : '#16a34a' }}; font-size: 1.25rem;">
                  <i class="fa {{ $isUpcoming ? 'fa-clock-o' : 'fa-check-circle' }}"></i>
                </div>
                <div>
                  <h6 class="fw-bold text-dark mb-1 fs-6">{{ $anouncement->name }}</h6>
                  <div class="d-flex align-items-center gap-2 text-muted small">
                    <span class="badge bg-light text-dark border">
                      <i class="fa fa-calendar me-1 text-danger"></i> {{ \Carbon\Carbon::parse($anouncement->datetime)->format('d-m-Y') }}
                    </span>
                    <span class="badge {{ $isUpcoming ? 'bg-info text-white' : 'bg-success text-white' }}">
                      {{ $isUpcoming ? __('Sắp diễn ra') : __('Đã hoàn thành') }}
                    </span>
                  </div>
                </div>
              </div>

              <div>
                <form action="{{ route('announcement.delete', $anouncement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Bạn có chắc muốn xóa thông báo này?') }}');">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                    <i class="fa fa-trash me-1"></i> {{ __('Delete') }}
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  @if (session('success') || session('error'))
    <div class="alert_custom">
      <div class="list">
        @if (session('success'))
          <div class="item success">
            <div class="title">{{ session('success') }}</div>
          </div>
        @endif
        @if (session('error'))
          <div class="item error">
            <div class="title">{{ session('error') }}</div>
          </div>
        @endif
      </div>
    </div>
  @endif
@endsection
