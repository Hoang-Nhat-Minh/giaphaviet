@extends('screens.auth.layout')

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="auth-page-header border-0 m-0 p-0">
          <i class="fa fa-file-text-o me-2"></i> {{ __('Documents and Texts') }}
        </h2>
        <a class="btn btn-danger px-4 py-2 rounded-pill font-weight-bold" href="{{ route('document.add') }}" style="background:#b02522; border:none; box-shadow: 0 4px 12px rgba(176, 37, 34, 0.3);">
          <i class="fa fa-upload me-1"></i> {{ __('Tải lên tài liệu') }}
        </a>
      </div>

      @if ($docs->isEmpty())
        <div class="alert text-center rounded-pill p-3 font-weight-bold" style="background:#fbf2ed; border: 1px solid rgba(176,37,34,0.2); color:#8e1c19;">
          <i class="fa fa-info-circle me-2"></i> Chưa có tài liệu nào
        </div>
      @else
        <div class="table-responsive rounded-4 border overflow-hidden">
          <table class="table align-middle m-0">
            <thead style="background: #fbf2ed; color: #8e1c19;">
              <tr>
                <th class="text-center py-3" style="width: 60px;">STT</th>
                <th class="py-3">{{ __('Tên tài liệu') }}</th>
                <th class="py-3">{{ __('Publishser') }}</th>
                <th class="py-3">{{ __('Created at') }}</th>
                <th class="py-3">Dung lượng</th>
                <th class="text-center py-3" style="width: 160px;">{{ __('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($docs as $index => $doc)
                <tr class="border-bottom">
                  <td class="text-center py-3 fw-bold text-muted">{{ $index + 1 }}</td>
                  <td class="py-3">
                    <span class="fw-bold text-dark"><i class="fa fa-file-pdf-o text-danger me-2"></i>{{ $doc->name }}</span>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-light text-dark border"><i class="fa fa-user me-1 text-danger"></i>{{ $doc->user->name }}</span>
                  </td>
                  <td class="py-3 text-muted small">
                    <i class="fa fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($doc->created_at)->format('d-m-Y') }}
                  </td>
                  <td class="py-3">
                    @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($doc->file))
                      @php
                        $sizeInBytes = \Illuminate\Support\Facades\Storage::disk('public')->size($doc->file);
                        $sizeInMB = number_format($sizeInBytes / (1024 * 1024), 2);
                      @endphp
                      <span class="badge bg-secondary">{{ $sizeInMB }} MB</span>
                    @else
                      <span class="badge bg-warning text-dark">File not found</span>
                    @endif
                  </td>
                  <td class="text-center py-3">
                    <div class="btn-group btn-group-sm" role="group">
                      <a href="{{ Storage::url($doc->file) }}" class="btn btn-outline-primary" target="_blank" title="{{ __('View') }}"><i class="fa fa-eye"></i></a>
                      <form action="{{ route('document.delete', $doc->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('Bạn có chắc muốn xóa tài liệu này?') }}');">
                        @csrf
                        @method('DELETE')
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