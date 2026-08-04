@extends('pages.landingpage.layout')

@section('extra-css')
  {{-- FANCYBOX --}}
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  {{-- FANCYBOX --}}
@endsection

@section('content')
  @include('pages.landingpage.elements.header')
  <div class="inner-page-wrapper">
    <div id="breadcrumb" class="division">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="primary-color">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Some interfaces') }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <section id="single-post" class="wide-100 single-post-section division pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="single-post-title text-center mb-40">
              <h4 class="h3-sm">{{ __('Preserve the flow of time with a sophisticated family tree template') }}</h4>
            </div>


            <div class="row">
              @foreach ($templates as $template)
                <div class="col-md-6 col-lg-4">
                  <div class="project-2 wow fadeInUp" data-wow-delay="0.4s"
                    style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <a href="{{ Voyager::image($template->image) }}">
                      <!-- Project Preview -->
                      <div class="hover-overlay">
                        <img class="img-fluid" src="{{ Voyager::image($template->image) }}" data-fancybox="gallery"
                          alt="template" style="height:200px;object-fit:cover">
                      </div>
                      <p class="text-center text-muted">{{ $template->translate()->name }}</p>
                    </a>
                  </div>
                </div>
              @endforeach
              <a href="{{ route('register') }}" class="btn btn-md btn-primary tra-black-hover wow fadeInUp"
                data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;margin-left:auto;
                margin-right:auto;">
                {{ __('Try now') }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('extra-js')
  {{-- FANCYBOX --}}
  <script>
    Fancybox.bind("[data-fancybox]", {});
  </script>
@endsection
