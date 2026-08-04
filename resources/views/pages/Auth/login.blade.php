@extends('pages.Auth.main')
@section('content')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem 1.5rem;
      background: transparent;
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .login-card {
      width: 100%;
      max-width: 480px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 32px;
      border: 1px solid rgba(176, 37, 34, 0.14);
      box-shadow: 0 25px 70px rgba(176, 37, 34, 0.14);
      padding: 3rem 2.5rem;
      transition: all 0.3s ease;
    }

    .login-card:hover {
      box-shadow: 0 30px 80px rgba(176, 37, 34, 0.18);
    }

    .login-logo {
      transition: transform 0.3s ease;
    }
    .login-logo:hover {
      transform: scale(1.04);
    }

    .test-account-badge {
      background: #fbf2ed;
      border: 1px solid rgba(176, 37, 34, 0.2);
      border-radius: 20px;
      padding: 12px 16px;
      color: #8e1c19;
      font-size: 0.875rem;
      font-weight: 500;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      line-height: 1.5;
    }

    .custom-input {
      width: 100%;
      padding: 14px 20px;
      border-radius: 30px;
      border: 1.5px solid #e2e8f0;
      background-color: #f8fafc;
      font-size: 0.95rem;
      color: #1e293b;
      font-family: inherit;
      transition: all 0.25s ease;
      outline: none;
    }

    .custom-input:focus {
      border-color: #b02522;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(176, 37, 34, 0.12);
    }

    .custom-input.error-input {
      border-color: #ef4444;
      background-color: #fef2f2;
    }

    .btn-login-submit {
      width: 100%;
      padding: 14px 24px;
      border-radius: 30px;
      background: linear-gradient(135deg, #b02522 0%, #8e1c19 100%);
      color: #ffffff;
      font-weight: 700;
      font-size: 1.05rem;
      font-family: inherit;
      border: none;
      box-shadow: 0 6px 20px rgba(176, 37, 34, 0.3);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-login-submit:hover {
      background: linear-gradient(135deg, #961e1b 0%, #751513 100%);
      box-shadow: 0 8px 25px rgba(176, 37, 34, 0.45);
      transform: translateY(-1px);
    }

    .btn-login-submit:active {
      transform: translateY(0);
    }
  </style>

  <div class="login-container">
    <div class="login-card">
      <div class="text-center mb-8">
        <a href="{{ route('index') }}" class="inline-block login-logo">
          <img class="w-44 h-auto mx-auto" src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </a>
        <h1 class="text-2xl font-extrabold text-gray-900 mt-5 tracking-tight">
          {{ __('Login') }}
        </h1>
      </div>

      <div class="test-account-badge mb-6">
        <svg class="w-5 h-5 flex-shrink-0 text-red-700 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Quý khách có thể đăng nhập bằng tài khoản <strong class="text-red-800 font-bold">test@test.com</strong> để dùng thử hệ thống!</span>
      </div>

      <form class="space-y-6" action="{{ route('authenticate') }}" method="POST">
        @csrf

        <div>
          <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-1">{{ __('Email') }}</label>
          @if ($errors->has('email'))
            <input type="email" name="email" id="email"
              class="custom-input error-input"
              placeholder="{{ $errors->first('email') }}">
          @else
            <input type="email" name="email" id="email"
              class="custom-input"
              placeholder="{{ __('Email') }}" value="test@test.com">
          @endif
        </div>

        <div>
          <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-1">{{ __('Password') }}</label>
          @if ($errors->has('password'))
            <input type="password" name="password" id="password"
              class="custom-input error-input"
              placeholder="{{ $errors->first('password') }}">
          @else
            <input type="password" name="password" id="password"
              class="custom-input"
              placeholder="{{ __('Password') }}" value="12345678">
          @endif
        </div>

        <div class="flex items-center justify-between pt-1">
          <label for="remember" class="inline-flex items-center cursor-pointer select-none">
            <input id="remember" name="remember" type="checkbox"
              class="w-4 h-4 text-red-700 border-gray-300 rounded focus:ring-red-500 cursor-pointer">
            <span class="ml-2.5 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</span>
          </label>
        </div>

        <div class="pt-2">
          <button type="submit" class="btn-login-submit">
            {{ __('Login') }}
          </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-6">
          {{ __('Dont have an account?') }}
          <a href="{{ route('register') }}" class="font-bold text-red-700 hover:text-red-900 transition-colors ml-1">
            {{ __('Register') }}
          </a>
        </p>
      </form>
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
        <div class="item" x-show="item.show" x-transition:enter="transition_all" x-transition:enter-start="enter_start"
          x-transition:enter-end="enter_end" x-transition:leave="transition_all" x-transition:leave-start="leave_start"
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
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('alert', () => ({
        index: 0,
        list: [],
        init() {
          let alert = JSON.parse(`@json(session()->get('alert'))`)

          console.log(alert)

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
