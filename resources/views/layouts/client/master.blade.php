<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <title>Kacana - Túi xách cho mọi nhà</title>
    <meta name="keywords" content="tui-xach-dep" />
    <meta name="description" content="Kacana - Hệ thống túi xách chuyên nghiệp">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-theme.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/lib/fontawesome/css/font-awesome.css">

    <link rel="stylesheet" href="/lib/owlcarousel/owl.carousel.min.css" media="screen">
    <link rel="stylesheet" href="/lib/owlcarousel/owl.theme.default.min.css" media="screen">
    <link rel="stylesheet" href="/lib/magnific-popup/magnific-popup.css" media="screen">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/lib/theme/css/theme.css">
    <link rel="stylesheet" href="/lib/theme/css/theme-elements.css">
    <link rel="stylesheet" href="/lib/theme/css/theme-blog.css">
    <link rel="stylesheet" href="/lib/theme/css/theme-shop.css">
    <link rel="stylesheet" href="/lib/theme/css/theme-animate.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="/lib/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" href="/lib/circle-flip-slideshow/css/component.css" media="screen">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/lib/theme/css/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/lib/theme/css/custom.css">

    <!-- Head Libs -->
    <script src="/lib/modernizr/modernizr.js"></script>

    <!--[if IE]>
    <link rel="stylesheet" href="/lib/theme/css/ie.css">
    <![endif]-->

    <!-- css owner -->
    <link rel="stylesheet" href="/css/client/client.css">

    <!--[if lte IE 8]>
    <script src="/lib/respond/respond.js"></script>
    <script src="/lib/excanvas/excanvas.js"></script>
    <![endif]-->

</head>
<body>
<div class="body">

    @include('layouts.client.header')

    <div role="main" class="main">
        @include('layouts.client.slide')

        {{--@include('layouts.client.home-intro')--}}

        @yield('content')

    </div>

    @include('layouts.client.footer')

</div>

<!-- Vendor -->
<script charset="utf-8" type="text/javascript" src="/lib/jquery/jquery-2.1.3.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="/lib/jquery/jquery.appear/jquery.appear.js"></script>
<script src="/lib/jquery/jquery.easing/jquery.easing.js"></script>
<script src="/lib/jquery/jquery-cookie/jquery-cookie.js"></script>

<script charset="utf-8" type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="/lib/common/common.js"></script>
<script src="/lib/jquery/jquery.validation/jquery.validation.js"></script>
<script src="/lib/jquery/jquery.stellar/jquery.stellar.js"></script>
<script src="/lib/jquery/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="/lib/jquery/jquery.gmap/jquery.gmap.js"></script>
<script src="/lib/isotope/jquery.isotope.js"></script>
<script src="/lib/owlcarousel/owl.carousel.js"></script>
<script src="/lib/jflickrfeed/jflickrfeed.js"></script>
<script src="/lib/magnific-popup/jquery.magnific-popup.js"></script>
<script src="/lib/vide/vide.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/lib/theme/js/theme.js"></script>

<!-- Specific Page Vendor and Views -->
<script src="/lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="/lib/circle-flip-slideshow/js/jquery.flipshow.js"></script>
<script src="/lib/theme/js/view.home.js"></script>

<!-- Theme Custom -->
<script src="/lib/theme/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/lib/theme/js/theme.init.js"></script>

<!-- js owner -->
<script src="/js/client/client.js"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-12345678-1']);
    _gaq.push(['_trackPageview']);

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
 -->
<script type="text/javascript">

    $(function() {
        @yield('javascript')
    });
</script>

</body>
</html>