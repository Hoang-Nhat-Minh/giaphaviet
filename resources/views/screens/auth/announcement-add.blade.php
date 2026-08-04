@extends('screens.auth.layout')


@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">

    <div class="container mt-5">
      <form class="border border-3 p-3 shadow" style="background: rgba(255,255,255,0.4)" method="POST"
        action="{{ route('announcement.store') }}">
        @csrf

        <style>
          .error-placeholder::-webkit-input-placeholder {
            /* WebKit, Blink, Edge */
            color: red !important;
          }

          .error-placeholder:-moz-placeholder {
            /* Mozilla Firefox 4 to 18 */
            color: red !important;
            opacity: 1;
          }

          .error-placeholder::-moz-placeholder {
            /* Mozilla Firefox 19+ */
            color: red !important;
            opacity: 1;
          }

          .error-placeholder:-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            color: red !important;
          }

          .error-placeholder::-ms-input-placeholder {
            /* Microsoft Edge */
            color: red !important;
          }

          .error-placeholder::placeholder {
            /* Most modern browsers support this now. */
            color: red !important;
          }
        </style>

        <div class="mb-3">
          <label for="name" class="form-label">Tên thông báo</label>
          @if ($errors->has('name'))
            <input type="text" class="form-control error-placeholder" id="name" name="name"
              placeholder="{{ $errors->first('name') }}">
          @else
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thông báo"
              value="{{ old('name') }}">
          @endif
        </div>
        <div class="mb-3">
          <label for="datetime" class="form-label">Ngày báo</label>
          <input type="date" class="form-control" id="datetime" name="datetime">
          @if ($errors->has('datetime'))
            <div class="alert alert-danger mt-2">
              {{ $errors->first('datetime') }}
            </div>
          @endif
        </div>
        <div class="input-group mb-3">
          <label class="input-group-text" for="options">Thông báo trước</label>
          <select class="form-select" id="options" name="options">
            <option value="0" selected>Trước 5 ngày</option>
            <option value="1">Mỗi tuần</option>
            <option value="2">Mỗi tháng</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm thông báo</button>
      </form>
    </div>
  </section>
@endsection
