@extends('pages.landingpage.layout')

@section('extra-css')
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
                            <h3 class="h3-xl">{{ $category->name }}</h3>
                            <p>{{ $category->short_des }}</p>
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
                                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="primary-color">Trang chủ</a></li>
                                <li class="breadcrumb-item" aria-current="page">Danh mục</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section id="blog-2" class="bg-lightgrey pt-30 blog-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 reviews-grid">
                        <h4>{{ $category->name }}</h4>
                        <div style="text-align: justify">
                            {!! $category->des !!}
                        </div>
                    </div>
                </div>
                <!-- BLOG POSTS -->
                <div class="row">
                    <div class="col-md-12 reviews-grid pt-20">
                        <div class="masonry-wrap grid-loaded">
                            @foreach ($posts as $post)
                                <div class="masonry-item">
                                    <div class="blog-post">
                                        <!-- BLOG POST IMAGE -->
                                        <div class="blog-post-img">
                                            <img class="img-fluid" src="{{ Voyager::image($post->thumbnail('cropped')) }}"
                                                 alt="blog-post-image" />
                                        </div>
                                        <!-- BLOG POST TEXT -->
                                        <div class="blog-post-txt">
                                            <!-- Post Tag -->
                                            <p class="post-read"><i class="fa fa-calendar"></i> {{ $post->created_at->format('d-m-Y') }}</p>
                                            <!-- Post Link -->
                                            <h5 class="h5-md">
                                                <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                                            </h5>
                                            <p class="grey-color"
                                               style="white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;">
                                                {{ $post->excerpt }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

    {{ $posts->links() }}
@endsection

@section('extra-js')
@endsection
