@extends('screens.layouts.' . $template)

@section('extra-css')
    {{-- FANCYBOX --}}
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    {{-- FANCYBOX --}}
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .gallery-item {
            width: calc(25% - 10px);
            /* 4 items per row */
            position: relative;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            /* Set uniform height */
            object-fit: cover;
            /* Ensure the image maintains aspect ratio */
        }

        @media (max-width: 768px) {
            .gallery-item {
                width: calc(50% - 10px);
                /* 2 items per row on smaller screens */
            }
        }
    </style>
@endsection

@section('main')
    <h1 class="text-center py-5 great-vibes-regular" style="font-size: 65px; color: #ad5904;">Thư viện ảnh</h1>

    <div class="container" style="min-height:90vh">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <!-- Cột trái - Danh sách danh mục -->
            <div class="col-md-3">
                <h2 class="mb-3 great-vibes-regular" style="color: #ad5904;">Danh mục</h2>
                @foreach ($categorise_album as $category)
                    <div class="mb-1 border rounded shadow p-2 d-flex justify-content-between align-items-center"
                        style="background-color: rgba(255, 255, 255, 0.5);">
                        <a href="{{ route('temple', ['branch_id' => $branch->id, 'slug_gia_pha' => $slug_gia_pha, 'category_slug' => $category->slug]) }}"
                            style="color: inherit; text-decoration: none;">
                            {{ $category->name }}
                        </a>
                        <form action="{{ route('album.category.delete') }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                        </form>
                    </div>
                @endforeach
                <button class="btn mt-3 text-white" data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                    style="background-color: #ad5904;">Thêm danh mục</button>
            </div>

            <!-- Cột phải - Thư viện hình ảnh -->
            <div class="col-md-9">
                <div class="d-flex mb-3 justify-content-end align-items-center">
                    <button class="btn text-white me-2" style="background-color: #ad5904;" data-bs-toggle="modal"
                        data-bs-target="#addImageModal">Thêm hình ảnh</button>
                    <button class="btn text-white bg-danger" data-bs-toggle="modal" data-bs-target="#deleteImageModal">Xóa
                        hình
                        ảnh</button>
                </div>
                <div class=" gallery" id="gallery">
                    @if ($current_category && $current_category->images && $current_category->images->count() > 0)
                        @foreach ($current_category->images as $album)
                            {{--              <div class="col-6 col-md-4 mb-4"> --}}
                            <a class="gallery-item" data-fancybox="gallery" data-caption="{{ $album->name }}"
                                href="{{ Voyager::image($album->image) }}">
                                <img src="{{ Voyager::image($album->image) }}"
                                    class="img-fluid rounded border border-dark shadow-sm" alt="{{ $album->name }}">
                            </a>
                            {{--              </div> --}}
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p class="fw-bold text-danger">Không có hình ảnh nào trong danh mục này.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal thêm danh mục -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('album.category.store', ['branch_id']) }}" method="POST" id="categoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="categoryName" name="name" maxlength="255"
                                required>
                            <small id="charCount" class="text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn text-white" style="background-color: #ad5904;">Thêm</button>
                    </form>

                    <script>
                        document.getElementById('categoryForm').addEventListener('submit', function(event) {
                            let categoryName = document.getElementById('categoryName').value;
                            let maxLength = 255;

                            if (categoryName.length > maxLength) {
                                alert('Tên danh mục không được vượt quá ' + maxLength + ' ký tự.');
                                event.preventDefault(); // Ngăn form gửi đi
                            }
                        });

                        // Hiển thị số ký tự còn lại khi người dùng nhập
                        document.getElementById('categoryName').addEventListener('input', function() {
                            let maxLength = 255;
                            let currentLength = this.value.length;
                            let charCountElement = document.getElementById('charCount');

                            if (currentLength > maxLength) {
                                charCountElement.textContent = 'Bạn đã vượt quá giới hạn ' + maxLength + ' ký tự!';
                                charCountElement.style.color = 'red';
                            } else {
                                charCountElement.textContent = 'Ký tự còn lại: ' + (maxLength - currentLength);
                                charCountElement.style.color = '';
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal thêm hình ảnh -->
    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Thêm hình ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($current_category)
                        <form action="{{ route('album.image.store') }}" method="POST" enctype="multipart/form-data"
                            id="imageForm">
                            @csrf
                            <div class="mb-3">
                                <label for="imageName" class="form-label">Tên ảnh</label>
                                <input type="text" class="form-control" id="imageName" name="image_name"
                                    maxlength="255" required>
                                <small id="charCount" class="text-muted"></small>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*" required>
                                <small id="fileError" class="text-muted"></small>
                            </div>
                            <input type="hidden" value="{{ $current_category->id }}" name="category_id">
                            <button type="submit" class="btn btn text-white"
                                style="background-color: #ad5904;">Thêm</button>
                        </form>
                    @else
                        <div class="alert alert-warning" role="alert">
                            Không có danh mục hiện tại để thêm hình ảnh. Vui lòng chọn danh mục trước.
                        </div>
                    @endif


                    <script>
                        document.getElementById('imageForm').addEventListener('submit', function(event) {
                            // Kiểm tra độ dài tên ảnh
                            let imageName = document.getElementById('imageName').value;
                            let maxLength = 255;

                            if (imageName.length > maxLength) {
                                alert('Tên ảnh không được vượt quá ' + maxLength + ' ký tự.');
                                event.preventDefault();
                                return;
                            }

                            // Kiểm tra loại file và kích thước
                            let imageFile = document.getElementById('image').files[0];
                            let fileError = document.getElementById('fileError');
                            fileError.textContent = ''; // Reset thông báo lỗi

                            if (imageFile) {
                                let validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                                let maxSize = 2 * 1024 * 1024; // 2MB

                                if (!validTypes.includes(imageFile.type)) {
                                    fileError.textContent = 'File phải là ảnh (jpeg, png, gif, webp).';
                                    fileError.style.color = 'red';
                                    event.preventDefault();
                                    return;
                                }

                                if (imageFile.size > maxSize) {
                                    fileError.textContent = 'Kích thước file không được vượt quá 2MB.';
                                    fileError.style.color = 'red';
                                    event.preventDefault();
                                    return;
                                }
                            } else {
                                alert('Vui lòng chọn một file hình ảnh.');
                                event.preventDefault();
                            }
                        });

                        // Hiển thị số ký tự còn lại khi người dùng nhập tên ảnh
                        document.getElementById('imageName').addEventListener('input', function() {
                            let maxLength = 255;
                            let currentLength = this.value.length;
                            let charCountElement = document.getElementById('charCount');

                            if (currentLength > maxLength) {
                                charCountElement.textContent = 'Bạn đã vượt quá giới hạn ' + maxLength + ' ký tự!';
                                charCountElement.style.color = 'red';
                            } else {
                                charCountElement.textContent = 'Ký tự còn lại: ' + (maxLength - currentLength);
                                charCountElement.style.color = '';
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xóa hình ảnh -->
    <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageModalLabel">Xóa hình ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($current_category && $current_category->images && $current_category->images->count() > 0)
                                @foreach ($current_category->images as $album)
                                    <tr>
                                        <td>{{ $album->name }}</td>
                                        <td>
                                            <img src="{{ Voyager::image($album->image) }}" alt="{{ $album->name }}"
                                                style="height: 50px;width: 50px;object-fit: cover;">
                                        </td>
                                        <td>
                                            <form action="{{ route('album.image.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="image_id" value="{{ $album->id }}">
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Không có hình ảnh nào trong danh mục này.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: rgba(255, 228, 225, 0.8);
            /* Màu nền nhẹ và trong suốt */
        }

        .list-group-item {
            background-color: rgba(255, 255, 255, 0.9);
            /* Nền trong suốt cho danh sách danh mục */
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.7);
            /* Màu nền khi hover */
        }

        .img-fluid {
            transition: transform 0.3s;
            /* Hiệu ứng chuyển tiếp khi di chuột */
        }

        .img-fluid:hover {
            transform: scale(1.05);
            /* Phóng to hình ảnh khi hover */
        }
    </style>
@endsection

@section('js')
    {{-- FANCYBOX --}}
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
@endsection
