<?php
/**
 * The header for our theme.
 *
 * @package Smart Blog
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
<script id="timelyScript" src="//book.gettimely.com/widget/book-button-v1.3.js"></script>
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

<?php if( tps_get_option('enable_preloader') == '1' ) { ?>
	<div id="preloader">
		<div id="preloader-inner">
			<div class="spinner">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>
<?php } ?>

<div id="wrapper" class="clearfix">

	<?php
		if( is_singular() ) {
			global $post;
			$enable_sticky_header = rwmb_meta( 'themepixels_enable_sticky_header', '', $post->ID );
			if( $enable_sticky_header == 'default' || $enable_sticky_header == '' ) {
				if( tps_get_option('sticky_header') == '1' ) {
					get_template_part( 'framework/header/sticky-header' );
				}
			} else {
				if( $enable_sticky_header == 'yes' ) {
					get_template_part( 'framework/header/sticky-header' );
				}
			}
		} else {
			if( tps_get_option('sticky_header') == '1' ) {
				get_template_part( 'framework/header/sticky-header' );
			}
		}
	?>

	<div class="header-wrapper">
		
		<?php
			if( is_singular() ) {
				global $post;
				$enable_topbar = rwmb_meta( 'themepixels_enable_topbar', '', $post->ID );
				if( $enable_topbar == 'default' || $enable_topbar == '' ) {
					if( tps_get_option('top_bar') == '1' ) {
						get_template_part( 'framework/header/top-bar' );
					}
				} else {
					if( $enable_topbar == 'yes' ) {
						get_template_part( 'framework/header/top-bar' );
					}
				}
			} else {
				if( tps_get_option('top_bar') == '1' ) {
					get_template_part( 'framework/header/top-bar' );
				}
			}
		?>

		<?php
			$header_layout = tps_get_option('header_layout');
			if( is_singular() ) {
				global $post;
				$meta = rwmb_meta( 'themepixels_header_layout', '', $post->ID );
				if( $meta == 'default' || $meta == '' ) {
					$header_layout = tps_get_option('header_layout');
				} else {
					$header_layout = $meta;
				}
			}
		?>

		<?php get_template_part( 'framework/header/header', $header_layout ); ?>

		<?php
			if( is_singular() ) {
				global $post;
				$enable_sticky_header = rwmb_meta( 'themepixels_enable_sticky_header', '', $post->ID );
				if( $enable_sticky_header == 'default' || $enable_sticky_header == '' ) {
					if( tps_get_option('sticky_header') == '1' ) { ?>
						<div class="init-sticky-header"></div>
					<?php }
				} else {
					if( $enable_sticky_header == 'yes' ) { ?>
						<div class="init-sticky-header"></div>
					<?php }
				}
			} else {
				if( tps_get_option('sticky_header') == '1' ) { ?>
					<div class="init-sticky-header"></div>
				<?php }
			}
		?>

	</div><!-- End .header-wrapper -->