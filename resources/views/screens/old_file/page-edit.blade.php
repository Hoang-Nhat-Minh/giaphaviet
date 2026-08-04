{{-- @extends('screens.layouts.' . $template)

@section('extra-css')
  <script src="https://cdn.tiny.cloud/1/coimli1zufzen9bkrl2hlb0aldob0hpzwmhh4ovc0q8inm1o/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#page-edit'
    });
  </script>
@endsection

@section('main')
  <form method="post"
    action="{{ route('edit.page.update', ['branch_id' => Auth::user()->branch_id, 'slug_gia_pha' => $slug_gia_pha, 'slug_bai_viet' => $page->slug]) }}">
    @csrf

    <div class="fixed-bottom d-flex justify-content-end my-3 mx-2" style="z-index: 9999;">
      <button type="submit" class="btn"
        style="font-family: Playwrite NZ; font-size: smaller; padding: 10px; text-decoration: none; color: black; background-color: #ffce31; border-radius: 15%; border: 2px solid #ffa004;">
        LƯU
      </button>
    </div>
    <div class="container">
      <div class="row">
        <h1 class="text-center py-5 great-vibes-regular" style="font-size: 65px;color:#ad5904">
          {{ $page->title ?? '' }}
        </h1>
        <textarea id="page-edit" style="height:80vh" name="body">{!! $page->body ?? '' !!}</textarea>
      </div>
    </div>
  </form>

  <script>
    var template = {{ Auth::user()->template }};
  </script>
@endsection --}}
