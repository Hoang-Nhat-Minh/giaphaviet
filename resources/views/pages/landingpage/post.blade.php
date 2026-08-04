@extends('pages.landingpage.layout')

@section('extra-css')
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
                <li class="breadcrumb-item"><a href="{{ route('blog') }}"
                    class="primary-color">{{ $post->category->translate()->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->translate()->title }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <section id="single-post" class="wide-100 single-post-section division">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="single-post-title text-center mb-40">
              <h3 class="h3-sm">{{ $post->translate()->title }}</h3>
              <!-- Post Data -->
              <div class="single-post-data">
                <p class="post-meta">
                <p class="post-read"><i class="fa fa-calendar"></i> {{ $post->created_at->format('d-m-Y') }}</p>
                </p>
              </div>
            </div>
            <div style="text-align: justify;">
              {!! $post->translate()->body !!}
            </div>

            <div class="row mt-40">
              <a href="{{ route('login') }}" class="btn btn-md btn-primary tra-black-hover"
                style="margin-left:auto;margin-right:auto">{{ __('Register for trial') }}</a>
            </div>


            <!-- SINGLE POST SHARE LINKS -->
            <div class="row post-share-links d-flex align-items-center">
              <!-- POST TAGS -->
              <div class="col-md-9 col-xl-8 post-tags-list">
                {{-- @dd($post->meta_keywords) --}}
                @if (!empty($post->meta_keywords))
                  Tag: <span><a href="#">{{ $post->meta_keywords }}</a></span>
                @endif
              </div>

              <!-- POST SHARE ICONS -->
              <div class="col-md-3 col-xl-4 post-share-list text-right">
                <ul class="share-social-icons text-center clearfix">
                  @php
                    $facebookShare = urlencode(url()->current()) . '&amp;src=sdkpreparse';
                    $url = url()->current();
                  @endphp
                  <li>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $facebookShare }}"
                      class="share-ico ico-facebook">
                      <i class="fab fa-facebook-square"></i>
                    </a>
                  </li>

                  <li>
                    <a target="_blank" href="https://twitter.com/intent/tweet?url={{ $url }}"
                      class="share-ico ico-twitter"><i class="fab fa-twitter"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- END SINGLE POST SHARE -->
          </div>
        </div>
      </div>
    </section>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
      src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0&appId=1098960451224710" nonce="GsW9l16N">
    </script>
  @endsection

  @section('extra-js')
  @endsection
