@extends('screens.layouts.' . $template)

@section('main')
  <div class="container py-4">
      <h1 class="text-center py-4 great-vibes-regular" style="font-size: 50px; color: #8e1c19;">
        {{ __('Introduction to the Family Clan') }}
      </h1>
      <div class="content-card mb-5" style="background: rgba(255, 255, 255, 0.95); border-radius: 28px; padding: 2.5rem; border: 1px solid rgba(176, 37, 34, 0.08); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);">
        @if (!empty($page->body) && trim(strip_tags($page->body)) != '')
          <div style="text-align: justify; line-height: 1.8;">
            {!! $page->body !!}
          </div>
        @else
          <div class="text-center py-4 text-muted" style="font-style: italic;">
            <i class="fa fa-info-circle me-1"></i> {{ __('This section has no data yet') }}
          </div>
        @endif
      </div>

      <h1 class="text-center py-4 great-vibes-regular" style="font-size: 50px; color: #8e1c19;">
        {{ __('Temple') }}
      </h1>
      @include('screens.vr3ddata')

      <div style="text-align: center; padding-bottom: 60px;">
        <h1 class="text-center pt-5 great-vibes-regular" style="font-size: 42px; color: #8e1c19;">
          {{ __('Timeline of the Family Clan') }}
        </h1>
        @php
          $familyHome = auth()->user()->familyHome->first();
        @endphp
        @if ($familyHome && !empty($familyHome->timeline))
          <img class="w-100 rounded-4 border shadow-sm my-3" src="{{ Voyager::image($familyHome->timeline) }}" alt="Timeline" style="max-width: 650px;">
        @else
          <div class="text-center py-3 text-muted" style="font-style: italic;">
            <i class="fa fa-info-circle me-1"></i> {{ __('This section has no data yet') }}
          </div>
        @endif

        <h1 class="text-center pt-5 great-vibes-regular" style="font-size: 42px; color: #8e1c19;">
          {{ __('List Of The Clan Leader') }}
        </h1>
        @if ($familyHome && !empty($familyHome->important_people))
          <img class="w-100 rounded-4 border shadow-sm my-3" src="{{ Voyager::image($familyHome->important_people) }}" alt="Important People" style="max-width: 650px;">
        @else
          <div class="text-center py-3 text-muted" style="font-style: italic;">
            <i class="fa fa-info-circle me-1"></i> {{ __('This section has no data yet') }}
          </div>
        @endif
      </div>
  </div>

  <script>
    var template = {{ Auth::user()->template }};
  </script>
@endsection
