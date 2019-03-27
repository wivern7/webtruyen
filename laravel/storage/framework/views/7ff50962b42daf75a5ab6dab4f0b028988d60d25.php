<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <?php echo $__env->yieldContent('seo'); ?>
    <?php echo \App\Option::getvalue('pageheader'); ?>

    <meta name="google-site-verification" content="<?php echo \App\Option::getvalue('google_veri'); ?>" />
    <meta property="fb:admins" content="<?php echo e(\App\Option::getvalue('fb_admin_id')); ?>" />
    <meta property="fb:app_id" content="<?php echo e(\App\Option::getvalue('fb_app')); ?>" />
    <script src="https://apis.google.com/js/platform.js" async defer>
      {lang: 'vi'}
    </script>
</head>
<body>
<?php /*Facebook*/ ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=" + <?php echo e(\App\Option::getvalue('fb_app')); ?>;
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="wrapper" id="backOnTop">
<?php echo $__env->make('partials.navibar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="ads container">
    <?php echo \App\Option::getvalue('ads_header'); ?>

</div>

<?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <div class="clearfix"></div>
    <div class="ads container">
        <?php echo \App\Option::getvalue('ads_footer'); ?>

    </div>

    <div class="footer">
        <div class="container">
            <div class="hidden-xs col-sm-5">
                <?php echo \App\Option::getvalue('copyright'); ?>

            </div>
            <ul class="col-xs-12 col-sm-7 list-unstyled">
                <li class="text-right pull-right">
                    <a href="<?php echo e(url('contact')); ?>" title="Contact">Contact</a> - <a href="<?php echo e(url('tos')); ?>" title="Terms of Service">ToS</a> - <a href="<?php echo e(url('sitemap.xml')); ?>" title="Sitemap" target="_blank">Sitemap</a><a class="backtop" href="#backOnTop" rel="nofollow"><span class="glyphicon glyphicon-upload"></span></a>
                </li>
                <li class="hidden-xs tag-list"></li>
            </ul>
        </div>
    </div>
</div> <!-- #Wrapper -->

<!-- Jquery -->
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<!-- bootstrap -->
<script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
<!-- My Script -->
<script src="<?php echo e(asset('assets/js/dinhquochan.js')); ?>"></script>

<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

    __gaTracker('create', '<?php echo \App\Option::getvalue('google_analytics'); ?>', 'auto');
    __gaTracker('set', 'forceSSL', true);
    __gaTracker('send','pageview');
</script>

<?php echo \App\Option::getvalue('pagefooter'); ?>

</body>
</html>