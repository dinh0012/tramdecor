<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="icon" href="<?php echo get_template_directory_uri() ?>/img/favicon-1-min.png" sizes="32x32" />
	<link rel="icon" href="<?php echo get_template_directory_uri() ?>/img/favicon-1-min.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/img/favicon-1-min.png" />
	<?php wp_head(); ?>
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1664704833833240'); // Insert your pixel ID here.
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
				   src="https://www.facebook.com/tr?id=1664704833833240&ev=PageView&noscript=1"
		/></noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->
	<!-- TruConversion for charmoutsourcing.com -->
	<script type="text/javascript">
		var _tip = _tip || [];
		(function(d,s,id){
			var js, tjs = d.getElementsByTagName(s)[0];
			if(d.getElementById(id)) { return; }
			js = d.createElement(s); js.id = id;
			js.async = true;
			js.src = d.location.protocol + '//app.truconversion.com/ti-js/8362/b086d.js';
			tjs.parentNode.insertBefore(js, tjs);
		}(document, 'script', 'ti-js'));
	</script>
	<title><?php the_title() ?></title>
</head>
<body <?php body_class(); ?>>


<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=202509823216589";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<div class="wrapper_main">
	<head>
		<?php get_template_part( 'template-parts/header/top-bar' ); ?>
		<?php get_template_part( 'template-parts/header/menu-header' ); ?>
	</head>

