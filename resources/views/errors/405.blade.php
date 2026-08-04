@extends('pages.landingpage.layout')

@section('extra-css')
@endsection

@section('content')
    @include('pages.landingpage.elements.header')

    <div class="inner-page-wrapper">
        <section id="single-post" class="wide-60 single-post-section division">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="text-align: center;">
                        <img width="420px" src="{{ asset('/storage/icon/image_2024-09-10_141933745.png') }}" alt="404">
                    </div>
                    <div class="col-lg-12 pt-30" style="text-align: center;">
                        <h4 class="pb-20">Xin lỗi! Tôi không tìm thấy nội dung bạn cần.</h4>
                        <a class="btn btn-md btn-primary tra-black-hover" href="{{asset('/')}}">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('extra-js')
@endsection
