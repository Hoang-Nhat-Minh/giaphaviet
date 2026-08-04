@extends('screens.layouts.' . $template)

@section('main')
  <div class="container broder rounded shadow p-2" style="min-height:90vh">
    <div class="fb-comments w-100" data-href="https://giaphaviet.kennatech.vn/{{ $branch_id }}/{{ $slug_gia_pha }}/dien_dan"
      data-numposts="5" data-width="100%"></div>
  </div>


  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v23.0&appId=562203893033282"
    nonce="QvLceZQH"></script>


{{--   <div class="container border rounded shadow">--}}
{{--    <div class="commentbox mt-5" style="min-height:90vh"></div>--}}
{{--  </div>--}}
{{--  <script src="https://unpkg.com/commentbox.io/dist/commentBox.min.js"></script>--}}
{{--  <script>--}}
{{--    commentBox('5717044213317632-proj', {--}}
{{--      sortOrder: 'best',--}}
{{--    })--}}
{{--  </script>--}}

{{--   <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>--}}
{{--  <script>--}}
{{--    // Enable pusher logging - don't include this in production--}}
{{--    Pusher.logToConsole = true;--}}

{{--    var pusher = new Pusher('17fe112e365abed48c2f', {--}}
{{--      cluster: 'ap1'--}}
{{--    });--}}

{{--    var channel = pusher.subscribe('gia-pha-dien-dan');--}}
{{--    channel.bind('my-event', function(data) {--}}
{{--      alert(JSON.stringify(data));--}}
{{--    });--}}
{{--  </script>--}}

  {{-- Commento --}}
{{--   <script defer src="https://cdn.commento.io/js/commento.js"></script>--}}
{{--<div class="container">--}}
{{--    <div id="commento"></div>--}}
{{--</div>--}}


{{--   <script type="text/javascript">--}}
{{--        window.$crisp = [];--}}
{{--        window.CRISP_WEBSITE_ID = "091c0c23-2afb-4e14-908c-78865739c677";--}}
{{--        (function() {--}}
{{--            d = document;--}}
{{--            s = d.createElement("script");--}}
{{--            s.src = "https://client.crisp.chat/l.js";--}}
{{--            s.async = 1;--}}
{{--            d.getElementsByTagName("head")[0].appendChild(s);--}}
{{--        })();--}}
{{--    </script>--}}
@endsection
