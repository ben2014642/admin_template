<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

@stack('lib-css')
<link rel="stylesheet" href="{{ asset('libs/tabler/dist/css/tabler.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropzone/css/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/rateyo/css/rateyo.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/owlcarousel/css/owl.carousel.min.css')
}}">
<link rel="stylesheet" href="{{
asset('libs/owlcarousel/css/owl.theme.default.min.css') }}">

<link rel="stylesheet" href="{{ asset('libs/virtualselect/css/virtual-
select.min.css') }}">

<link rel="stylesheet" href="{{ asset('libs/fancybox/fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('libs/virtualselect/css/tooltip.min.css')
}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-
bundle.min.css" />

<title>Bất động sản</title>
@stack('custom-css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
