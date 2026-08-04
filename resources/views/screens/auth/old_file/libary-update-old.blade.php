@extends('screens.auth.layout')

@section('css')
  <style>
    .image-preview {
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin-right: 10px;
      border-radius: 5px;
    }

    .video-item {
      margin-bottom: 15px;
    }

    .video-item iframe {
      width: 100%;
      height: 200px;
      border-radius: 5px;
    }

    .add-video-btn {
      margin-top: 10px;
    }
  </style>
@endsection

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">

    <form class="w-100 m-5 border border-3 rounded p-3" style="background: rgba(0, 0, 0, 0.8)" method="POST"
      action="{{ route('library.save') }}" enctype="multipart/form-data">
      @csrf

      <style>
        .error-placeholder::-webkit-input-placeholder {
          color: red !important;
        }

        .error-placeholder::-moz-placeholder {
          color: red !important;
        }

        .error-placeholder:-ms-input-placeholder {
          color: red !important;
        }

        .error-placeholder::placeholder {
          color: red !important;
        }
      </style>

      <div class="mb-3">
        <label for="eventName" class="form-label">Tên sự kiện</label>
        @if ($errors->has('name'))
          <input type="text" class="form-control error-placeholder" id="eventName" name="name"
            placeholder="{{ $errors->first('name') }}" value="{{ old('name', $library->name) }}">
        @else
          <input type="text" class="form-control" id="eventName" name="name" placeholder="{{ __('Event Name') }}"
            value="{{ old('name', $library->name) }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="Date" class="form-label">Ngày sự kiện</label>
        @if ($errors->has('date'))
          <input type="date" class="form-control error-placeholder" id="Date" name="datetime">
          <div class="alert alert-danger mt-2">
            {{ $errors->first('date') }}
          </div>
        @else
          <input type="date" class="form-control" id="Date" name="datetime"
            value="{{ old('date', \Carbon\Carbon::parse($library->date)->format('Y-m-d')) }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Ảnh</label>
        <input type="file" class="form-control" id="images" name="imgs[]" multiple>
        @if ($errors->has('imgs'))
          <div class="alert alert-danger mt-2">
            {{ $errors->first('imgs') }}
          </div>
        @endif
        <div class="mt-3">
          <div id="image-preview" class="d-flex flex-wrap">
            @if ($library->imgs)
              @foreach (json_decode($library->imgs, true) as $img)
                <img src="{{ asset('storage/' . $img) }}" class="image-preview">
              @endforeach
            @endif
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="videos" class="form-label">Link video sự kiện</label>
        <div id="video-container">
          <div class="video-item">
            @if ($errors->has('videos'))
              <textarea class="form-control error-placeholder" name="videos" placeholder="{{ $errors->first('videos') }}">{{ old('videos', $library->videos) }}</textarea>
            @else
              <textarea class="form-control" name="videos" placeholder="Nhập link video" style="min-height: 300px">{{ old('videos', $library->videos) }}</textarea>
            @endif
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật sự kiện</button>
    </form>
  </section>
@endsection

@section('js')
  <script>
    // Preview images on file selection
    document.getElementById('images').addEventListener('change', function(event) {
      const previewContainer = document.getElementById('image-preview');
      previewContainer.innerHTML = ''; // Clear existing previews
      const files = event.target.files;
      for (const file of files) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.classList.add('image-preview');
        previewContainer.appendChild(img);
      }
    });
  </script>
@endsection
