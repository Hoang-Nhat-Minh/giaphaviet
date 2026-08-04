@extends('screens.auth.layout')

@section('content')
  <section id="content" class="d-flex align-items-center justify-content-center"
    style="background-image: url('{{ asset('assets/images/auth_background/background.png') }}');">
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-12">
          <!-- Post content-->
          <article>
            <!-- Post header-->
            <header class="mb-4">
              <!-- Post title-->
              <h1 class="mb-1">{{ $library->name }}</h1>
              <!-- Post meta content-->
              <div class="text-muted fst-italic mb-2"><i class="fa fa-calendar" aria-hidden="true"></i>
                {{ \Carbon\Carbon::parse($library->datetime)->format('d-m-Y') }}</div>
            </header>
            <!-- Preview image figure-->
            <figure class="mb-4"><img class="img-fluid rounded" src="{{ Voyager::image($library->img) }}"
                alt="..." /></figure>
            <!-- Post content-->
            <section class="mb-5">
              {!! $library->content !!}
            </section>
          </article>
        </div>
      </div>
    </div>
  </section>
@endsection
