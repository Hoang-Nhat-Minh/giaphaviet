@extends('screens.auth.layout')

@section('css')
  <script src="https://cdn.tiny.cloud/1/coimli1zufzen9bkrl2hlb0aldob0hpzwmhh4ovc0q8inm1o/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#page-edit'
    });
  </script>
@endsection

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <h2 class="auth-page-header">
        <i class="fa fa-pencil me-2"></i> {{ __('Edit Family About') }}
      </h2>

      <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label class="form-label fw-bold text-dark mb-2">{{ __('Nội dung bài giới thiệu gia tộc') }}</label>
          <textarea id="page-edit" style="height: 50vh;" name="body">{!! $page->body ?? '' !!}</textarea>
        </div>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border">
              <label for="timeline" class="form-label fw-bold text-dark mb-2">
                <i class="fa fa-clock-o me-1 text-danger"></i> {{ __('Timeline dòng họ (Ảnh)') }}
              </label>
              <input type="file" class="form-control rounded-pill mb-3" id="timeline" name="timeline"
                onchange="previewImage(this, 'timeline-preview')" />
              <img src="{{ Voyager::image(auth()->user()->familyHome->first()->timeline) }}" alt="timeline"
                id="timeline-preview" class="rounded-3 w-100" style="max-height:220px; object-fit:cover;" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border">
              <label for="important_people" class="form-label fw-bold text-dark mb-2">
                <i class="fa fa-users me-1 text-danger"></i> {{ __('Thành viên chủ chốt / Trưởng tộc (Ảnh)') }}
              </label>
              <input type="file" class="form-control rounded-pill mb-3" id="important_people" name="important_people"
                onchange="previewImage(this, 'important_people-preview')" />
              <img src="{{ Voyager::image(auth()->user()->familyHome->first()->important_people) }}"
                alt="important_people" id="important_people-preview"
                class="rounded-3 w-100" style="max-height:220px; object-fit:cover;" />
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end pt-2">
          <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-bold" style="background:#b02522; border:none; box-shadow: 0 4px 12px rgba(176, 37, 34, 0.3);">
            <i class="fa fa-save me-1"></i> {{ __('Lưu thay đổi') }}
          </button>
        </div>
      </form>
    </div>
  </section>
@endsection

@section('js')
  <script>
    function previewImage(input, previewId) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection
