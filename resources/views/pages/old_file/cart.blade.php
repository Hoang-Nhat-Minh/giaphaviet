@extends('pages.landingpage.layout')

@section('extra-css')
  <style>
    .vsm-text:hover {
      color: #FF5252;
    }

    .border-top {
      border-top: 1px solid #EEEEEE !important;
      margin-top: 20px;
      padding-top: 15px;
    }

    .card {
      margin: 40px 0px;
      padding: 40px 50px;
      border-radius: 20px;
      border: none;
      box-shadow: 1px 5px 10px 1px rgba(0, 0, 0, 0.2);
    }

    input,
    textarea {
      background-color: #F3E5F5;
      padding: 8px 15px 8px 15px;
      width: 100%;
      border-radius: 5px !important;
      box-sizing: border-box;
      border: 1px solid #F3E5F5;
      font-size: 15px !important;
      color: #000 !important;
      font-weight: 300;
    }

    input:focus,
    textarea:focus {
      -moz-box-shadow: none !important;
      -webkit-box-shadow: none !important;
      box-shadow: none !important;
      border: 1px solid #9FA8DA;
      outline-width: 0;
      font-weight: 400;
    }

    button:focus {
      -moz-box-shadow: none !important;
      -webkit-box-shadow: none !important;
      box-shadow: none !important;
      outline-width: 0;
    }

    .pay {
      width: 80px;
      height: 40px;
      border-radius: 5px;
      border: 1px solid #673AB7;
      margin: 10px 20px 10px 0px;
      cursor: pointer;
      box-shadow: 1px 5px 10px 1px rgba(0, 0, 0, 0.2);
    }

    .gray {
      -webkit-filter: grayscale(100%);
      -moz-filter: grayscale(100%);
      -o-filter: grayscale(100%);
      -ms-filter: grayscale(100%);
      filter: grayscale(100%);
      color: #E0E0E0;
    }

    .gray .pay {
      box-shadow: none;
    }

    #tax {
      border-top: 1px lightgray solid;
      margin-top: 10px;
      padding-top: 10px;
    }

    .btn-blue {
      border: none;
      border-radius: 10px;
      background-color: #673AB7;
      color: #fff;
      padding: 8px 15px;
      margin: 20px 0px;
      cursor: pointer;
    }

    .btn-blue:hover {
      background-color: #311B92;
      color: #fff;
    }

    #checkout {
      float: left;
    }

    #check-amt {
      float: right;
    }

    @media screen and (max-width: 768px) {

      .book,
      .book-img {
        width: 100px;
        height: 150px;
      }

      .card {
        padding-left: 15px;
        padding-right: 15px;
      }

      .mob-text {
        font-size: 13px;
      }

      .pad-left {
        padding-left: 20px;
      }
    }
  </style>
@endsection

@section('content')
  @include('pages.landingpage.elements.header')

  <div class="inner-page-wrapper">
    <div id="breadcrumb" class="bg-lightgrey division">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="primary-color">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <section id="blog-2" class="bg-lightgrey blog-section division">
      <div class="container px-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
          <div class="col-5 p-0">
            <h4 class="heading">Tên dịch vụ</h4>
          </div>
          <div class="col-7">
            <div class="row text-right">
              <div class="col-4">
                <h6 class="mt-2">Loại dịch vụ</h6>
              </div>
              <div class="col-4">
                <h6 class="mt-2">Giá</h6>
              </div>
              <div class="col-4">
                <h6 class="mt-2">Tưởng tác</h6>
              </div>
            </div>
          </div>
        </div>

        @if (!$cart->isEmpty())
          @foreach ($cart as $item)
            {{-- Item --}}
            <div class="row d-flex justify-content-center border-top">
              <div class="col-5">
                <div class="row d-flex">
                  <div class="my-auto flex-column d-flex pad-left">
                    {{-- @dd($item->service->first()->title) --}}
                    <p class="mob-text">{{ $item->service->first()->title }}</p>
                  </div>
                </div>
              </div>
              <div class="my-auto col-7">
                <div class="row text-right">
                  <div class="col-4">
                    <p class="mob-text">
                      @if ($item->service_type == 0)
                        Giao diện
                      @elseif ($item->service_type == 1)
                        Gói quản lý gia phả
                      @elseif ($item->service_type == 2)
                        Gói Thiết kế - Quay phim - Chụp ảnh
                      @endif
                    </p>
                  </div>
                  <div class="col-4">
                    <div class="row d-flex justify-content-end px-3">
                      <p class="mob-text">
                        {{ $item->service->first()->price }}
                      </p>
                    </div>
                  </div>
                  <div class="col-4">
                    <form action="{{ route('cart.delete') }}" method="POST" class="d-inline">
                      @csrf

                      <input type="hidden" name="id" value="{{ $item->id }}">
                      <button class="btn btn-sm btn-primary tra-black-hover">Hủy dịch vụ</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            {{-- EndItem --}}
          @endforeach
        @else
          <div class="alert alert-warning">
            Không có dịch vụ nào trong giỏ hàng
          </div>
        @endif

        <div class="row justify-content-center">
          <div class="col-lg-12">
            <form action="{{ route('checkout') }}" method="POST" class="card">
              @csrf

              <div class="row">
                <div class="col-lg-12">
                  <div class="row px-2">
                    <div class="form-group col-md-6">
                      <label class="form-control-label">Họ và tên</label>
                      <input type="text" id="name" name="name" placeholder="Họ và tên"
                        value="{{ old('name') }}">
                      @if ($errors->has('name'))
                        <div id="nameError" class="form-text text-danger">
                          {{ $errors->first('name') }}
                        </div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-control-label">Số điện thoại</label>
                      <input type="text" id="phone" name="phone" placeholder="Số điện thoại"
                        value="{{ old('phone') }}">
                      @if ($errors->has('phone'))
                        <div id="phoneError" class="form-text text-danger">
                          {{ $errors->first('phone') }}
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="row px-2">
                    <div class="form-group col-md-6">
                      <label class="form-control-label">Email</label>
                      <input type="email" id="email" name="email" placeholder="Email"
                        value="{{ old('email') }}">
                      @if ($errors->has('email'))
                        <div id="emailError" class="form-text text-danger">
                          {{ $errors->first('email') }}
                        </div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-control-label">Địa chỉ</label>
                      <input type="text" id="address" name="address" placeholder="Địa chỉ"
                        value="{{ old('address') }}">
                      @if ($errors->has('address'))
                        <div id="addressError" class="form-text text-danger">
                          {{ $errors->first('address') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  <button type="submit" class="btn btn-sm btn-primary tra-black-hover w-100">Xác nhận giỏ hàng
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
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
          x-transition:enter-start="enter_start" x-transition:enter-end="enter_end" x-transition:leave="transition_all"
          x-transition:leave-start="leave_start" x-transition:leave-end="leave_end" :class="item.type">
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
