{{-- @extends('screens.layouts.' . $template)

@section('main')
  <div class="fixed-bottom d-flex justify-content-end my-3 mx-2">
    <a href="{{ route('edit.page.view', ['branch_id' => Auth::user()->branch_id, 'slug_gia_pha' => $slug_gia_pha, 'slug_bai_viet' => $page->slug]) }}"
      class="btn"
      style="font-family: Playwrite NZ; font-size: smaller; padding: 10px; text-decoration: none; color: black; background-color: #ffce31; border-radius: 15%; border: 2px solid #ffa004;">
      SỬA
    </a>
  </div>
  <div class="container">
    <div class="row">
      <h1 class="text-center py-5 great-vibes-regular" style="font-size: 65px; color: #ad5904;">
        {{ $page->title ?? '' }}
      </h1>
      {!! $page->body ?? '' !!}
    </div>
  </div>
  <script>
    var template = {{ Auth::user()->template }};
  </script>
@endsection --}}
