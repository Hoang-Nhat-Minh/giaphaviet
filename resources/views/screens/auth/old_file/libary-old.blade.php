@extends('screens.auth.layout')

@section('css')
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <!-- Add any additional CSS you need here -->
  <style>
    .scrolling-wrapper {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      padding-bottom: 10px;
    }

    .scrolling-wrapper::-webkit-scrollbar {
      height: 6px;
    }

    .scrolling-wrapper::-webkit-scrollbar-thumb {
      background-color: #aaa;
      border-radius: 10px;
    }

    .video-item {
      flex: 0 0 auto;
      width: 200px;
      margin-right: 15px;
    }

    .video-item img {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .event-header {
      background-color: #f8f9fa;
      padding: 10px 15px;
      border-radius: 5px 5px 0 0;
      text-align: center;
    }

    .image-library {
      background-color: #f0f0f0;
      display: flex;
      border-bottom: 2px solid #ddd;
    }

    .add-event-btn {
      position: absolute;
      top: 15px;
      right: 15px;
    }

    .container {
      position: relative;
    }

    .event-item {
      margin-bottom: 20px;
    }

    .event-item:last-child {
      margin-bottom: 0;
    }

    @media screen and (max-width: 768px) {
      #event-container {
        margin-top: 75px !important;
      }
    }
  </style>
@endsection

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">
    <a href="{{ route('library.add') }}" class="btn btn-primary add-event-btn">Thêm sự kiện</a>
    <div class="container my-5 py-3 position-relative">
      @if ($libaries->isEmpty())
        <div class="alert alert-warning">
          Không có sự kiện nào.
        </div>
      @else
        @foreach ($libaries as $library)
          <div class="event-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h3 class="mb-1">{{ $library->name }}</h3>
              <p class="ms-3 mb-0"><i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($library->datetime)->format('d-m-Y') }}</p>
            </div>
            <div>
              <form action="{{ route('library.delete', $library->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-danger">Xóa sự kiện</button>
              </form>
              <a href="{{ route('library.edit', $library->id) }}" class="btn btn-success">Sửa sự kiện</a>
            </div>
          </div>

          <div class="image-library m-0 row">
            @foreach (json_decode($library->imgs) as $key => $img)
              <a href="{{ Voyager::image($img) }}" data-fancybox="gallery{{ $library->id }}"
                data-caption="{{ $library->name }}" class="col-4 p-1">
                <img src="{{ Voyager::image($img) }}" alt="{{ $library->name }}"
                  style="width:100%;height:200px;object-fit:cover" />
              </a>
            @endforeach
          </div>

          <!-- Horizontal Video List for Event 1 -->
          <div class="scrolling-wrapper">
            @foreach (explode("\n", $library->videos) as $video)
              <div class="video-item">
                @php
                  $embedLink = str_replace('youtu.be/', 'www.youtube.com/embed/', trim($video));
                @endphp
                <iframe src="{{ $embedLink }}" frameborder="0" allowfullscreen height="200" width="200"></iframe>
              </div>
            @endforeach
            <!-- More video items -->
          </div>
        @endforeach
      @endif
    </div>
  </section>

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

@section('js')
  <script>
    Fancybox.bind("[data-fancybox]", {
      // Your custom options
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
