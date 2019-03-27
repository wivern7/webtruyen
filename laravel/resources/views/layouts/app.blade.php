<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('seo')
    {!! \App\Option::getvalue('pageheader') !!}
    <meta name="google-site-verification" content="{!! \App\Option::getvalue('google_veri') !!}" />
    <meta property="fb:admins" content="{{\App\Option::getvalue('fb_admin_id')}}" />
    <meta property="fb:app_id" content="{{\App\Option::getvalue('fb_app')}}" />
    <script src="https://apis.google.com/js/platform.js" async defer>
      {lang: 'vi'}
    </script>
</head>
<body>
{{--Facebook--}}
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=" + {{\App\Option::getvalue('fb_app')}};
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="wrapper" id="backOnTop">
@include('partials.navibar')

<div class="ads container">
    {!! \App\Option::getvalue('ads_header') !!}
</div>

@yield('content')

    <!-- Footer -->
    <div class="clearfix"></div>
    <div class="ads container">
        {!! \App\Option::getvalue('ads_footer') !!}
    </div>

    <div class="footer">
        <div class="container">
            <div class="hidden-xs col-sm-5">
                {!! \App\Option::getvalue('copyright') !!}
            </div>
            <ul class="col-xs-12 col-sm-7 list-unstyled">
                <li class="text-right pull-right">
                    <a href="{{url('contact')}}" title="Liên hệ">Liên hệ</a> - <a href="{{url('tos')}}" title="Terms of Service">Điều khoản</a> - <a href="{{url('sitemap.xml')}}" title="Sitemap" target="_blank">Sơ đồ</a><a class="backtop" href="#backOnTop" rel="nofollow"><span class="glyphicon glyphicon-upload"></span></a>
                </li>
                <li class="hidden-xs tag-list"></li>
            </ul>
        </div>
    </div>
</div> <!-- #Wrapper -->

<!-- Jquery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- My Script -->
<script src="{{ asset('assets/js/dinhquochan.js') }}"></script>

<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

    __gaTracker('create', '{!! \App\Option::getvalue('google_analytics') !!}', 'auto');
    __gaTracker('set', 'forceSSL', true);
    __gaTracker('send','pageview');
</script>

{!! \App\Option::getvalue('pagefooter') !!}
</body>
</html>