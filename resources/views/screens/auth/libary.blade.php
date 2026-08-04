@extends('screens.auth.layout')

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="auth-page-header border-0 m-0 p-0">
          <i class="fa fa-calendar me-2"></i> {{ __('History and Events') }}
        </h2>
        <a class="btn btn-danger px-4 py-2 rounded-pill font-weight-bold" href="{{ route('library.add') }}" style="background:#b02522; border:none; box-shadow: 0 4px 12px rgba(176, 37, 34, 0.3);">
          <i class="fa fa-plus me-1"></i> {{ __('Tạo sự kiện mới') }}
        </a>
      </div>

      @if ($libaries->isEmpty())
        <div class="alert text-center rounded-pill p-3 font-weight-bold" style="background:#fbf2ed; border: 1px solid rgba(176,37,34,0.2); color:#8e1c19;">
          <i class="fa fa-info-circle me-2"></i> Chưa có sự kiện nào
        </div>
      @else
        <div class="table-responsive rounded-4 border overflow-hidden">
          <table class="table align-middle m-0">
            <thead style="background: #fbf2ed; color: #8e1c19;">
              <tr>
                <th class="text-center py-3" style="width: 90px;">{{ __('Image') }}</th>
                <th class="py-3" style="width: 30%;">{{ __('Information') }}</th>
                <th class="py-3">{{ __('Short Description') }}</th>
                <th class="text-center py-3" style="width: 200px;">{{ __('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($libaries as $library)
                <tr class="border-bottom">
                  <td class="text-center py-3">
                    <img src="{{ Voyager::image($library->img) }}" alt="{{ $library->name }}" class="rounded-3" style="width: 65px; height: 65px; object-fit: cover;" />
                  </td>
                  <td class="py-3">
                    <a href="{{ route('library.view', $library->id) }}" class="fw-bold text-decoration-none text-danger fs-6" style="color: #8e1c19 !important;">
                      {{ $library->name }}
                    </a>
                    <div class="mt-1">
                      <span class="badge bg-light text-dark border">
                        <i class="fa fa-user text-danger me-1"></i> {{ $library->user->name }}
                      </span>
                      <span class="badge bg-light text-dark border ms-1">
                        <i class="fa fa-calendar text-danger me-1"></i> {{ \Carbon\Carbon::parse($library->datetime)->format('d-m-Y') }}
                      </span>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="text-secondary small">{{ $library->des }}</span>
                  </td>
                  <td class="text-center py-3">
                    <div class="btn-group btn-group-sm" role="group">
                      <a class="btn btn-outline-secondary" href="{{ route('library.view', $library->id) }}" title="{{ __('View') }}"><i class="fa fa-eye"></i></a>
                      <a class="btn btn-outline-primary" href="{{ route('library.edit', $library->id) }}" title="{{ __('Edit') }}"><i class="fa fa-pencil"></i></a>
                      <form action="{{ route('library.delete', $library->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('Bạn có chắc muốn xóa sự kiện này?') }}');">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-outline-danger rounded-end" title="{{ __('Delete') }}"><i class="fa fa-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
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
