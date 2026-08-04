@extends('screens.auth.layout')

@section('css')
  <script src="https://cdn.tiny.cloud/1/coimli1zufzen9bkrl2hlb0aldob0hpzwmhh4ovc0q8inm1o/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#event-edit',
      height: 500
    });
  </script>
@endsection

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">

    <form  class="m-5 border border-3 p-3 shadow" style="background: rgba(255,255,255,0.4)" method="POST"
      action="{{ route('library.store') }}" enctype="multipart/form-data">
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
        <label for="eventName" class="form-label">Tên sự kiện</label>
        @if ($errors->has('name'))
          <input type="text" class="form-control error-placeholder" id="eventName" name="name"
            placeholder="{{ $errors->first('name') }}">
        @else
          <input type="text" class="form-control" id="eventName" name="name" placeholder="{{ __('Event Name') }}"
            value="{{ old('name') }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="Image" class="form-label">Ảnh sự kiện</label>
        @if ($errors->has('img'))
          <input type="file" class="form-control error-placeholder" id="Image" name="img">
          <div class="alert alert-danger mt-2">
            {{ $errors->first('img') }}
          </div>
        @else
          <input type="file" class="form-control" id="Image" name="img" value="{{ old('img') }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="Date" class="form-label">Ngày sự kiện</label>
        @if ($errors->has('date'))
          <input type="date" class="form-control error-placeholder" id="Date" name="date">
          <div class="alert alert-danger mt-2">
            {{ $errors->first('date') }}
          </div>
        @else
          <input type="date" class="form-control" id="Date" name="date" value="{{ old('date') }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="Des" class="form-label">Giới thiệu ngắn</label>
        @if ($errors->has('des'))
          <input type="text" class="form-control error-placeholder" id="Des" name="des"
            placeholder="{{ $errors->first('des') }}">
        @else
          <input type="text" class="form-control" id="Des" name="des" placeholder="Nhập giới thiệu ngắn"
            value="{{ old('des') }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="event-edit" class="form-label">Nội dung</label>
        @if ($errors->has('content'))
          <textarea type="text" class="form-control error-placeholder" id="event-edit" name="content"></textarea>
          <div class="alert alert-danger mt-2">
            {{ $errors->first('content') }}
          </div>
        @else
          <textarea type="text" class="form-control" id="event-edit" name="content">{{ old('content') }}</textarea>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Thêm sự kiện</button>
    </form>
  </section>
@endsection
