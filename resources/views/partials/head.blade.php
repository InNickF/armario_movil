<head>
  <meta charset="UTF-8">
  <title>Armario Móvil</title>

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/images/favicons/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/images/favicons/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/images/favicons/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/images/favicons/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/images/favicons/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/images/favicons/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/images/favicons/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/images/favicons/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/favicons/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicons/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/favicons/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicons/favicon-16x16.png')}}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('/images/favicons/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">


  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {!! SEO::generate(true) !!}


<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-133444869-2', 'none', {
    userId: {{ auth()->check() ? auth()->user()->id : 0 }}
  });

  ga('set', 'dimension1', '{{ auth()->check() ? auth()->user()->id : 0 }}'); // if it's custom dimension1 = UserIdCustom STRING
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->

<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WBFXZGC');</script>
    <!-- End Google Tag Manager -->



<!-- Facebook Pixel Code -->

<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '549346602138514');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=549346602138514&ev=PageView&noscript=1"
/></noscript>

<!-- End Facebook Pixel Code -->


<!-- Start of HubSpot Embed Code -->

<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5724458.js"></script>

<!-- End of HubSpot Embed Code -->


  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- iCheck -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css"> --}}


  {{-- Ionicons --}}
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.min.css">

  {{-- Select2 --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

  {{-- JQUERY --}}
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  {{-- JQUERY --}}
  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}

  <link href="{{ config('services.paymentez.css') }}" rel="stylesheet" type="text/css" />


  <script src="https://cdn.tiny.cloud/1/hm1p5vgqpdq6zstbeu0l5dcfdafcf2ft7qh91hib3so0r6q4/tinymce/5/tinymce.min.js"></script>

  <link href="{{ asset('/css/app.css')}}" rel="stylesheet">

  {!! isset($map) ? $map['js'] : '' !!}

  @yield('css')

  @if (config('app.env') == 'production' || config('app.env') == 'staging')
  @laravelPWA
  @endif

</head>
