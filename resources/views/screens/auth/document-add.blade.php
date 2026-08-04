@extends('screens.auth.layout')

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">

    <div class="container">
      <form class="border border-3 p-3 shadow" style="background: rgba(255,255,255,0.4)" method="POST"
        action="{{ route('document.store') }}" enctype="multipart/form-data">
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
          <label for="name" class="form-label">Tên File</label>
          @if ($errors->has('name'))
            <input type="text" class="form-control error-placeholder" name="name" id="name"
              placeholder="{{ $errors->first('name') }}">
          @else
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
          @endif
        </div>

        <div class="mb-3">
          <label for="file" class="form-label">File</label>
          @if ($errors->has('file'))
            <input type="file" class="form-control error-placeholder" id="file" name="file">
            <div class="alert alert-danger">
              {{ $errors->first('file') }}
            </div>
          @else
            <input type="file" class="form-control" id="file" name="file">
          @endif
        </div>

        <button type="submit" class="btn btn-primary">Xác nhận</button>
      </form>
    </div>
  </section>
@endsection
