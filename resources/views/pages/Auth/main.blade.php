</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ Voyager::setting('site.title') }}</title>
  <link rel="shortcut icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">
  <link rel="icon" href="{{ Voyager::image(setting('site.logo')) }}" type="image/x-icon">

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
  {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <style>
    .bft-img-button {
      display: flex !important;
      justify-content: center;
    }

    .bft-edit-form-instruments {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <div style="background-image: url('{{ asset('assets/images/bg-body.png') }}')">
    @yield('content')
  </div>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  @yield('extra-js')
</body>

</html>
