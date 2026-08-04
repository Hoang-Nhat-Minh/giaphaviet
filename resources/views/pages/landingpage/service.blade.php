@extends('pages.landingpage.layout')

@section('extra-css')
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

  <div class="inner-page-wrapper">
    <section id="blog-listing-page" class="page-hero-section division"
      style="background-image: url({{ Voyager::image($blog_page->banner_image) }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="hero-txt text-center white-color">
              <h3 class="h3-xl">{{ __('Services') }}</h3>
              <!-- Text -->
              <p>{{ __('We offer a variety of service packages to suit the needs and budgets of our customers.') }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="breadcrumb" class="bg-lightgrey division">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="primary-color">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Services') }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <section id="blog-2" class="bg-lightgrey wide-60 blog-section division" style="padding-top: 50px;">
      <div class="container">
        <div class="row">
          <div class="col-md-12 reviews-grid">
            <h4 class="pb-10">{{ __('Genealogy Management') }}</h4>
            <div class="row list-service">
              @foreach ($services1 as $service)
                <div class="col-xl-4 col-md-4 col-sm-1 col-sx-1 col-4 item">
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
            <h4 class="pb-10">{{ __('Design - Filming - Photography Services') }}</h4>
            <div class="row list-service">
              @foreach ($services2 as $service)
                <div class="col-xl-4 col-md-4 col-sm-1 col-sx-1 col-4 item">
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
                <input type="text" class="form-control" id="phone" name="phone"
                  aria-describedby="phoneError" placeholder="Số điện thoại" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                  <small id="phoneError" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                @endif
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                  aria-describedby="emailError" placeholder="Enter email" value="{{ old('email') }}">
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
    {{-- Alert --}}
    <style>
      .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .alert_custom {
        position: fixed;
        pointer-events: none;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: 9999999999;
      }

      /* list */
      .alert_custom .list {
        display: flex;
        flex-direction: column;
        margin: 1rem;
        width: 100%;
        max-width: 400px;
        float: right;
      }

      /* item */
      .alert_custom .list .item {
        --line-height: 4px;
        position: relative;
        display: flex;
        align-items: center;
        padding: .5rem;
        color: #fff;
        border-radius: 0.25rem;
        overflow: hidden;
        padding-bottom: calc(.5rem + var(--line-height))
      }

      .alert_custom .list .item.success {
        background: #16A34A;
      }

      .alert_custom .list .item.error {
        background: #EAB308;
      }

      .alert_custom .list .item::after {
        content: "";
        position: absolute;
        width: 0;
        height: var(--line-height);
        background: #fff;
        bottom: 0;
        left: 0;
        animation: line 3s linear;
      }

      /* icon */
      .alert_custom .list .icon {
        flex: none;
        display: block;
        width: 40px;
        height: 40px;
      }

      .alert_custom .list .icon svg {
        width: 100%;
        height: 100%;
      }

      /* title */
      .alert_custom .list .title {
        min-width: 0;
        flex-grow: 1;
        margin-left: .5rem;
      }

      .alert_custom .list .title h6 {
        width: 100%;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 14px !important;
        color: inherit !important;
        font-weight: bold;
        line-height: 1.5;
        margin: 0;
      }

      .alert_custom .list .title p {
        width: 100%;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 12px !important;
        color: inherit !important;
        margin: 0rem !important;
        line-height: 1.5;
      }

      /* transiton */
      .transition_all {
        transition: all .3s ease-in-out;
      }

      .enter_start {
        transform: scale(0);
        opacity: 0;
      }

      .enter_end {
        transform: scale(1);
        opacity: 1;
      }

      .leave_start {
        transform: translateX(0);
        opacity: 1;
      }

      .leave_end {
        transform: translateX(100%);
        opacity: 0;
      }

      @keyframes line {
        from {
          width: 0;
        }

        to {
          width: 100%;
        }
      }
    </style>

    <div x-data="alert" class="alert_custom">
      <div class="list">
        <template x-for="item in list" :key="item.id">
          <div class="item" x-show="item.show" x-transition:enter="transition_all"
            x-transition:enter-start="enter_start" x-transition:enter-end="enter_end"
            x-transition:leave="transition_all" x-transition:leave-start="leave_start"
            x-transition:leave-end="leave_end" :class="item.type">
            <span class="icon">
              <template x-if="item.type == 'success'">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                  style="fill: currentColor">
                  <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                </svg>
              </template>
              <template x-if="item.type == 'error'">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                  style="fill: currentColor">
                  <path
                    d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z">
                  </path>
                  <path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path>
                </svg>
              </template>
            </span>
            <div class="title">
              <h6 class="truncate" x-text="item.title"></h6>
              <p x-text="item.body"></p>
            </div>
          </div>
        </template>
      </div>
    </div>
  @endsection

  @section('extra-js')
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('alert', () => ({
          index: 0,
          list: [],
          init() {
            // this.addAlert({body: 'dsa'})
            let alert = JSON.parse(`@json(session()->get('alert'))`)

            if (alert)
              this.addAlert(alert)
          },
          addAlert(alert) {
            this.list = [...JSON.parse(JSON.stringify(this.list)), {
              id: ++this.index,
              type: alert.type,
              title: alert.title,
              body: alert.body,
              show: false
            }]

            this.$nextTick(() => {
              this.list[this.index - 1].show = true
            })

            setTimeout(() => {
              this.list[this.index - 1].show = false
            }, 3000);
          }
        }))
      })
    </script>
  @endsection
