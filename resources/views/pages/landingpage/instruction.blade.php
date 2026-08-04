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
                <li class="breadcrumb-item active" aria-current="page">{{ __('Service user guide') }}</li>
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
              <h3 class="h3-sm">{{ __('How to use the Family Tree software') }}</h3>
            </div>

            <h4>{{ __('Register for the service') }}</h4>
            <p style="font-size: large;font-weight: 500">
              {{ __('When you sign up for our service, you will be able to use it for free for 7 days') }}</p>
            <img src="{{ asset('assets/images/intruction/huongdan1.png') }}" alt="huongdan" style="width: 100%;"
              draggable="false">

            <p class="mt-3" style="font-size: large;font-weight: 500">
              {{ __('Enter the required fields to create an account') }}</p>
            <img src="{{ asset('assets/images/intruction/huongdan2.png') }}" alt="huongdan" style="width: 100%;"
              draggable="false">

            <p class="mt-3" style="font-size: large;font-weight: 500">{{ __('Demo interface') }}</p>
            <img src="{{ asset('storage/landing-pages/demo_banner/demo2.png') }}" alt="huongdan" style="width: 100%;"
              draggable="false">

            <p class="mt-3" style="font-size: large;font-weight: 500">{{ __('Add member') }}</p>
            <img class="mb-2" src="{{ asset('assets/images/intruction/huongdan3.png') }}" alt="huongdan"
              style="width: 100%;" draggable="false">
            <img class="mb-2" src="{{ asset('assets/images/intruction/huongdan4.png') }}" alt="huongdan"
              style="width: 100%;" draggable="false">
            <img class="mb-2" src="{{ asset('assets/images/intruction/huongdan5.png') }}" alt="huongdan"
              style="width: 100%;" draggable="false">
            <img class="mb-2" src="{{ asset('assets/images/intruction/huongdan6.png') }}" alt="huongdan"
              style="width: 100%;" draggable="false">

            <p class="mt-3" style="font-size: large;font-weight: 500">{{ __('Search member') }}</p>
            <img src="{{ asset('assets/images/intruction/huongdan7.png') }}" alt="huongdan" style="width: 100%;"
              draggable="false">

            <p class="mt-3" style="font-size: large;font-weight: 500">{{ __('Change interface') }}</p>
            <img src="{{ asset('assets/images/intruction/huongdan8.png') }}" alt="huongdan" style="width: 100%;"
              draggable="false">

            <p class="mt-5 text-center" style="font-size: x-large;font-weight: 600">
              {{ __('If you have any questions about our service, please') }}
              <a href="{{ route('contacts') }}" class="text-danger">{{ __('Contact us') }}</a>
            </p>

            <div class="row mt-40">
              <a href="{{ route('login') }}" class="btn btn-md btn-primary tra-black-hover"
                style="margin-left:auto;margin-right:auto">{{ __('Register for trial') }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
