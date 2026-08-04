@extends('pages.landingpage.layout')

@section('extra-css')
  {{-- FANCYBOX --}}
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <style>
    #blog-2 .blog-post {
      margin: unset;
      height: 100%;
    }

    .list-service .item {
      padding-bottom: 30px;
    }

    .list-service .item .price {
      color: #f00;
    }

    .blog-post-txt {
      padding: 0 20px 20px;
    }
  </style>
@endsection

@section('content')
  @include('pages.landingpage.elements.header')

  <section id="hero-3" class="bg-scroll hero-section division"
    style="background-image: url({{ Voyager::image($content->banner_image) }});">
    <div class="container">
      <div class="row d-flex align-items-center" style="min-height: 350px;">
        {{-- <div class="col-md-8 col-xl-7 border rounded p-5" style="background-color: rgba(221, 23, 0, 0.7);">
          <div class="white-color">
            <h3>{{ $content->translate()->banner_text }}</h3>
            <p>{{ $content->translate()->banner_subtext }}
            </p>
            <a href="{{ route('register') }}" class="btn btn-md btn-primary tra-white-hover">{{ __('7-day trial') }}</a>
          </div>
        </div>
        <div class="col-md-4 col-xl-5">
          <div class="hero-3-btn play-btn-primary text-center">
            <a id="play-video" class="video-popup1 video-play-button" href="{{ $content->video_link }}">
              <span></span>
            </a>
          </div>
        </div> --}}
      </div>
    </div>
  </section>

  <section id="about-1" class="wide-60 about-section division">
    <div class="container">
      <div class="row d-flex">
        <!-- ABOUT IMAGE -->
        <div class="col-12 col-md-5 col-lg-6">
          <div class="img-block mb-40 wow fadeInLeft" data-wow-delay="0.6s">
            {{--            <img class="img-fluid" src="{{ Voyager::image($content->about_image) }}" alt="about-image" style="border-radius: 2%"> --}}
            <iframe src="{{ $content->video_link }}" frameborder="0" style="width: 100%; aspect-ratio: 16/9; height: auto; min-height: 240px; border-radius: 8px;"></iframe>
          </div>
        </div>

        <!-- ABOUT TEXT -->
        <div class="col-12 col-md-7 col-lg-6">
          <div class="txt-block pc-25 mb-40 wow fadeInRight" data-wow-delay="0.4s">
            <span style="text-align: justify">
              {!! $content->translate()->about_content !!}
            </span>
            <a href="{{ route('login') }}" class="btn btn-md btn-primary tra-black-hover">{{ __('Try now') }}</a>
          </div>
        </div> <!-- END ABOUT TEXT -->
      </div> <!-- End row -->
    </div> <!-- End container -->
  </section>

  <section id="blog-2" class="bg-lightgrey wide-60 blog-section division" style="padding-top: 50px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 section-title wow fadeInUp" data-wow-delay="0.2s"
          style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          <h3 class="h3-lg">{{ __('Services') }}</h3>
          <p class="p-lg">
            {{ __('We have genealogy management packages to suit many segments, along with support services.') }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 reviews-grid">
          <div class="row list-service">
            @foreach ($services1 as $service)
              <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 item">
                <div class="blog-post h-100 d-flex flex-column">
                  <div class="blog-post-img">
                    <img class="img-fluid" src="{{ Voyager::image($service->image) }}" alt="blog-post-image" />
                  </div>
                  <div class="blog-post-txt d-flex flex-column flex-grow-1">
                    <h5 class="h5-md">
                      <a href="{{ route('service.detail', $service->slug) }}">{{ $service->translate()->title }}</a>
                    </h5>
                    <h6 class="price">Giá: {{ $service->price }}</h6>
                    <div>
                      {!! $service->description !!}
                    </div>
                    <div class="pt-3 mt-auto">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-primary tra-black-hover" data-toggle="modal"
                        data-target="#formContactModel" data-id="{{ $service->id }}">
                        Đặt mua
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="col-md-12 reviews-grid" id="thiet-ke-truyen-thong">
          <div class="row list-service">
            @foreach ($services2 as $service)
              <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 item">
                <div class="blog-post h-100 d-flex flex-column">
                  <div class="blog-post-img">
                    <img class="img-fluid" src="{{ Voyager::image($service->thumbnail('cropped', 'image')) }}"
                      alt="blog-post-image" />
                  </div>
                  <div class="blog-post-txt d-flex flex-column flex-grow-1">
                    <h5 class="h5-md">
                      <a href="{{ route('service.detail', $service->slug) }}">{{ $service->translate()->title }}</a>
                    </h5>
                    <h6 class="price">Giá: {{ $service->price }}</h6>
                    <div>
                      {!! $service->description !!}
                    </div>
                    <div class="pt-3 mt-auto">
                      <button type="button" class="btn btn-sm btn-primary tra-black-hover" data-toggle="modal"
                        data-target="#formContactModel" data-id="{{ $service->id }}">
                        Đặt mua
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10 offset-lg-1 section-title wow fadeInUp" data-wow-delay="0.2s"
          style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          <a href="{{ route('service') }}" class="btn btn-primary black-hover mt-auto">Xem thêm</a>
        </div>
      </div>

    </div>
  </section>
  <!-- Modal -->
  <div class="modal fade mt-5" id="formContactModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Xin hãy điền thông tin của bạn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-3">
          <p>Xin hãy điền thông tin của bạn để chúng tôi có thể liên hệ sớm nhất có thể</p>
          <form action="{{ route('checkout') }}" method="POST">
            @csrf

            <input type="hidden" name="service_id" id="service_id" value="{{ old('service_id') }}">
            <div class="form-group">
              <label for="name">Họ và tên</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="nameError"
                placeholder="Họ và tên" value="{{ old('name') }}">
              @if ($errors->has('name'))
                <small id="nameError" class="form-text text-danger">{{ $errors->first('name') }}</small>
              @endif
            </div>
            <div class="form-group">
              <label for="phone">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneError"
                placeholder="Số điện thoại" value="{{ old('phone') }}">
              @if ($errors->has('phone'))
                <small id="phoneError" class="form-text text-danger">{{ $errors->first('phone') }}</small>
              @endif
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailError"
                placeholder="Enter email" value="{{ old('email') }}">
              @if ($errors->has('email'))
                <small id="emailError" class="form-text text-danger">{{ $errors->first('email') }}</small>
              @endif
            </div>
            <div class="form-group">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="address"
                aria-describedby="addressError" placeholder="Địa chỉ" value="{{ old('address') }}">
              @if ($errors->has('address'))
                <small id="addressError" class="form-text text-danger">{{ $errors->first('address') }}</small>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section id="projects-2" class="wide-70 projects-section division">
    <div class="container">
      <!-- SECTION TITLE -->
      <div class="row">
        <div class="col-lg-10 offset-lg-1 section-title wow fadeInUp" data-wow-delay="0.2s"
          style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          <h3 class="h3-lg">{{ $content->translate()->demo_header }}</h3>
          <p class="p-lg">{{ $content->translate()->demo_content }}</p>
        </div>
      </div>

      <!-- PROJECTS IMAGES HOLDER -->
      <div class="row">
        @foreach ($content->demo_image as $image)
          <div class="col-md-6 col-lg-4">
            <div class="project-2 wow fadeInUp" data-wow-delay="0.4s"
              style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
              <a href="{{ Voyager::image($image) }}">
                <!-- Project Preview -->
                <div class="hover-overlay">
                  <img class="img-fluid" src="{{ Voyager::image($image) }}" data-fancybox="gallery" alt="demo_image">
                </div>
              </a>
            </div>
          </div>
        @endforeach
        <a href="{{ route('login') }}" class="btn btn-md btn-primary tra-black-hover wow fadeInUp"
          data-wow-delay="0.4s"
          style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;margin-left:auto;
          margin-right:auto;">
          {{ __('Try now') }}</a>
      </div>
    </div> <!-- End container -->
  </section>

  <div class="section-divider">
    <div class="container">
      <div class="row">
        <div class="grey-border"></div>
      </div>
    </div>
  </div>

  <section id="projects-2" class="wide-70 projects-section division">
    <div class="container">
      <!-- SECTION TITLE -->
      <div class="row">
        <div class="col-lg-10 offset-lg-1 section-title wow fadeInUp" data-wow-delay="0.2s"
          style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
          <h3 class="h3-lg">{{ __('360° Experience from the Ancestral Hall') }}</h3>
          <p class="p-lg">
            {{ __('Explore the solemn and ancient beauty of the Ancestral Hall from every angle. Experience the sacred space of ancestor worship and the historical traditions of the family through vibrant 360° images') }}
          </p>
        </div>
      </div>

      <!-- PROJECTS IMAGES HOLDER -->
      <div class="row">
        <div class="col-lg-12">
          <video controls width="100%" style="border-radius: 8px;">
            <source src="{{ Voyager::image('video/demo_video.mp4') }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ thẻ video.
          </video>
        </div>
      </div>
    </div> <!-- End container -->
  </section>

  <div class="section-divider">
    <div class="container">
      <div class="row">
        <div class="grey-border"></div>
      </div>
    </div>
  </div>

  <section id="blog-1" class="wide-60 blog-section division">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 section-title wow fadeInUp" data-wow-delay="0.2s">
          <h3 class="h3-lg">{{ $content->translate()->blog_header }}</h3>
          <p class="p-lg">{{ $content->translate()->blog_subheader }}</p>
        </div>
      </div>

      <!-- BLOG POSTS -->
      <div class="row">
        @foreach ($posts as $post)
          <div class="col-md-6 col-lg-4">
            <div class="blog-post wow fadeInUp" data-wow-delay="0.4s">
              <!-- BLOG POST IMAGE -->
              <div class="blog-post-img">
                <img class="img-fluid" src="{{ Voyager::image($post->thumbnail('cropped')) }}"
                  alt="{{ $post->title }}" />
              </div>
              <div class="blog-post-txt">
                <!-- Post Tag -->
                <p class="post-read"><i class="far fa-clock"></i> {{ $post->created_at->format('d-m-Y') }}</p>
                <!-- Post Link -->
                <h5 class="h5-md">
                  <a href="{{ route('post', $post->slug) }}">{{ $post->translate()->title }}</a>
                </h5>
                <!-- Text -->
                <p class="grey-color"
                  style="white-space: nowrap;
                  overflow: hidden;
                  text-overflow: ellipsis;">
                  {{ $post->translate()->excerpt }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row">
        <div class="col-md-12 text-center">
          <div class="more-posts">
            <a href="{{ route('blog') }}"
              class="btn btn-md btn-primary tra-black-hover">{{ __('See more articles') }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra-js')
  {{-- FANCYBOX --}}
  <script>
    Fancybox.bind("[data-fancybox]", {});
    /*----------------------------------------------------*/
    /*	Video Link #1 Lightbox
    /*----------------------------------------------------*/

    $('.video-popup1').magnificPopup({
      type: 'iframe',
      iframe: {
        patterns: {
          youtube: {
            index: 'youtube.com',
            src: '{{ $content->video_link }}'
          }
        }
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('formContactModel'));
        myModal.show(); // Open the modal if validation errors exist
      @endif

      $('#formContactModel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var serviceId = button.data('id'); // Extract info from data-* attributes

        // Update the hidden input field with the service ID
        $('#service_id').val(serviceId);
      });
    });
  </script>
@endsection
