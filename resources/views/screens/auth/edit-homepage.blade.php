@extends('screens.auth.layout')

@section('css')
  <script src="https://cdn.tiny.cloud/1/coimli1zufzen9bkrl2hlb0aldob0hpzwmhh4ovc0q8inm1o/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#about',
    });
  </script>
@endsection

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center">
    <div class="auth-page-card">
      <h2 class="auth-page-header">
        <i class="fa fa-window-maximize me-2"></i> {{ __('Edit Home Page') }}
      </h2>

      <form method="POST" action="{{ route('update.family-landing-pages') }}" enctype="multipart/form-data" id="familyLandingPageForm">
        @csrf

        <div class="d-flex justify-content-end mb-4">
          <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-bold" style="background:#b02522; border:none; box-shadow: 0 4px 12px rgba(176, 37, 34, 0.3);">
            <i class="fa fa-save me-1"></i> {{ __('Lưu trang chủ') }}
          </button>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger rounded-4 mb-4">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="mb-4 p-3 bg-light rounded-4 border">
          <label for="banner" class="form-label fw-bold text-dark mb-2">
            <i class="fa fa-image me-1 text-danger"></i> Banner
          </label>
          <input type="file" class="form-control rounded-pill mb-3" id="banner" name="banner"
            onchange="previewImage(this, 'banner-preview')" />
          <img src="{{ Voyager::image($family_landing_page->banner) }}" alt="banner" id="banner-preview"
            class="rounded-3 w-100" style="max-height:260px; object-fit:cover;" />
        </div>

        <div class="mb-4">
          <label for="about" class="form-label fw-bold text-dark mb-2">
            <i class="fa fa-info-circle me-1 text-danger"></i> About (Giới thiệu)
          </label>
          <textarea id="about" name="about" style="height: 350px;">{{ $family_landing_page->about }}</textarea>
        </div>

        <div class="mb-4 p-3 bg-light rounded-4 border">
          <label for="about_image" class="form-label fw-bold text-dark mb-2">
            <i class="fa fa-picture-o me-1 text-danger"></i> About Image (Ảnh giới thiệu)
          </label>
          <input type="file" class="form-control rounded-pill mb-3" id="about_image" name="about_image"
            onchange="previewImage(this, 'about-image-preview')" />
          <img src="{{ Voyager::image($family_landing_page->about_image) }}" alt="about_image" id="about-image-preview"
            class="rounded-3 w-100" style="max-height:260px; object-fit:cover;" />
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border h-100">
              <label for="address" class="form-label fw-bold text-dark">
                <i class="fa fa-map-marker me-1 text-danger"></i> Address (Địa chỉ)
              </label>
              <textarea class="form-control rounded-3" id="address" name="address" rows="4">{{ $family_landing_page->address }}</textarea>
            </div>
          </div>

          <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border h-100">
              <label for="telephone" class="form-label fw-bold text-dark">
                <i class="fa fa-phone me-1 text-danger"></i> Telephone (Số điện thoại)
              </label>
              <textarea class="form-control rounded-3" id="telephone" name="telephone" rows="4">{{ $family_landing_page->telephone }}</textarea>
            </div>
          </div>

          <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border h-100">
              <label for="email" class="form-label fw-bold text-dark">
                <i class="fa fa-envelope me-1 text-danger"></i> Email
              </label>
              <textarea class="form-control rounded-3" id="email" name="email" rows="4">{{ $family_landing_page->email }}</textarea>
            </div>
          </div>
        </div>

        <div class="mb-4 p-3 bg-light rounded-4 border">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="form-label fw-bold text-dark m-0">
              <i class="fa fa-th me-1 text-danger"></i> Gallery (Thư viện ảnh)
            </label>
            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill font-weight-bold" onclick="addImageInput()">
              <i class="fa fa-plus me-1"></i> Thêm ảnh
            </button>
          </div>

          <div id="gallery-container" class="row g-3">
            @if ($family_landing_page->gallery)
              @foreach (json_decode($family_landing_page->gallery, true) as $index => $image)
                <div class="col-md-4 gallery-item">
                  <div class="p-2 border bg-white rounded-3 text-center">
                    <input type="hidden" name="gallery_existing[]" value="{{ $image }}">
                    <img src="{{ Voyager::image($image) }}" alt="gallery image" class="rounded mb-2 w-100" style="height: 160px; object-fit: cover;" />
                    <div class="btn-group btn-group-sm w-100" role="group">
                      <button type="button" class="btn btn-outline-secondary" onclick="moveImageUp(this, {{ $index }})" title="Lên"><i class="fa fa-arrow-up"></i></button>
                      <button type="button" class="btn btn-outline-secondary" onclick="moveImageDown(this, {{ $index }})" title="Xuống"><i class="fa fa-arrow-down"></i></button>
                      <button type="button" class="btn btn-outline-danger" onclick="removeImageInput(this, {{ $index }})" title="Xóa"><i class="fa fa-trash"></i></button>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection

@section('js')
  <script>
    function addImageInput() {
      const galleryContainer = document.getElementById('gallery-container');
      const index = galleryContainer.children.length;

      const div = document.createElement('div');
      div.classList.add('col-md-4', 'gallery-item');
      div.innerHTML = `
        <div class="p-2 border bg-white rounded-3 text-center">
          <input type="file" class="form-control form-control-sm mb-2 rounded-pill" name="gallery[]" onchange="uploadNewImage(this, ${index})" />
          <img id="gallery-preview-${index}" class="rounded mb-2 w-100" style="height: 160px; object-fit: cover; display: none;" />
          <div class="btn-group btn-group-sm w-100" role="group">
            <button type="button" class="btn btn-outline-secondary" onclick="moveImageUp(this, ${index})"><i class="fa fa-arrow-up"></i></button>
            <button type="button" class="btn btn-outline-secondary" onclick="moveImageDown(this, ${index})"><i class="fa fa-arrow-down"></i></button>
            <button type="button" class="btn btn-outline-danger" onclick="removeImageInput(this, ${index})"><i class="fa fa-trash"></i></button>
          </div>
        </div>
      `;

      galleryContainer.appendChild(div);
    }

    function previewImage(input, imgId) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById(imgId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function uploadNewImage(input, index) {
      const file = input.files[0];
      if (file) {
        const formData = new FormData();
        formData.append('gallery', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch('{{ route('gallery.add') }}', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const preview = document.getElementById(`gallery-preview-${index}`);
              preview.src = data.url;
              preview.style.display = 'block';
            } else {
              alert('Có lỗi xảy ra!');
            }
          })
          .catch(error => console.error('Error:', error));
      }
    }

    function removeImageInput(button, index) {
      const galleryContainer = document.getElementById('gallery-container');
      const item = button.closest('.gallery-item');
      fetch('{{ route('gallery.remove') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ index })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            galleryContainer.removeChild(item);
          } else {
            alert('Có lỗi xảy ra!');
          }
        })
        .catch(error => console.error('Error:', error));
    }

    function moveImageUp(button, index) {
      const item = button.closest('.gallery-item');
      const prevItem = item.previousElementSibling;
      if (prevItem) {
        fetch('{{ route('gallery.moveUp') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ index })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              window.location.reload(true);
            } else {
              alert('Có lỗi xảy ra!');
            }
          })
          .catch(error => console.error('Error:', error));
      }
    }

    function moveImageDown(button, index) {
      const item = button.closest('.gallery-item');
      const nextItem = item.nextElementSibling;
      if (nextItem) {
        fetch('{{ route('gallery.moveDown') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ index })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              window.location.reload(true);
            } else {
              alert('Có lỗi xảy ra!');
            }
          })
          .catch(error => console.error('Error:', error));
      }
    }
  </script>
@endsection
