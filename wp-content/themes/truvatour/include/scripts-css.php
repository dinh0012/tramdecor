<?php
/**
 * Enqueue scripts and styles for the front end.
 *
 */
function truvatour_scripts() {
	// Add Lato font, used in the main stylesheet.
	$fonts_url = truvatour_fonts_url();
	if ( ! empty( $fonts_url ) ){
		wp_enqueue_style( 'truvatour-fonts', esc_url_raw( $fonts_url ), array(), null );
	}
	wp_enqueue_style( 'bootstrap', TRUVATOURTHEMEURI . 'css/bootstrap.css', array(), null );
	wp_enqueue_style( 'bootstrap-select', TRUVATOURTHEMEURI . 'css/bootstrap-select.css', array(), null );
	wp_enqueue_style( 'font-awesome', TRUVATOURTHEMEURI . 'css/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'owl-carousel', TRUVATOURTHEMEURI . 'css/owl.carousel.css', array(), null );
	wp_enqueue_style( 'bootstrap-datetimepicker', TRUVATOURTHEMEURI . 'css/bootstrap-datetimepicker.min.css', array(), null );
	wp_enqueue_style( 'animate', TRUVATOURTHEMEURI . 'css/animate.css', array(), null );
	wp_enqueue_style( 'flexslider', TRUVATOURTHEMEURI . 'css/flexslider.css', array(), null );
	wp_enqueue_style( 'slimmenu', TRUVATOURTHEMEURI . 'css/slimmenu.css', array(), null );
	wp_enqueue_style( 'truvatour-styles', TRUVATOURTHEMEURI . 'css/style.css', array(), null );		

	// Load our main stylesheet.
	wp_enqueue_style( 'truvatour-style', get_stylesheet_uri() );
	wp_enqueue_style( 'truvatour-responsive', TRUVATOURTHEMEURI . 'css/responsive.css', array(), null );
	wp_enqueue_style( 'truvatour-custom-styles', TRUVATOURTHEMEURI . 'css/custom.css', array(), null );	
	wp_enqueue_style( 'truvatour-colors', TRUVATOURTHEMEURI . 'css/colors.css', array(), null );
	


	//scripts
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'bootstrap', TRUVATOURTHEMEURI . '/js/bootstrap.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'animate', TRUVATOURTHEMEURI . '/js/animate.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-appear', TRUVATOURTHEMEURI . '/js/lib/jquery.appear.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'counter', TRUVATOURTHEMEURI . '/js/lib/counter.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'owl-carousel', TRUVATOURTHEMEURI . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'parallax', TRUVATOURTHEMEURI . '/js/parallax.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'bootstrap-select', TRUVATOURTHEMEURI . '/js/bootstrap-select.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-easing', TRUVATOURTHEMEURI . 'js/lib/jquery.easing.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-slimmenu', TRUVATOURTHEMEURI . '/js/jquery.slimmenu.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'navgoco', TRUVATOURTHEMEURI . '/js/navgoco.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-fitvid', TRUVATOURTHEMEURI . '/js/jquery.fitvid.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'truvatour-upload', TRUVATOURTHEMEURI . '/js/upload.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'validate-min', TRUVATOURTHEMEURI . '/js/validate-min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-flexslider', TRUVATOURTHEMEURI . '/js/jquery.flexslider-min.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'truvatour-scripts', TRUVATOURTHEMEURI . 'js/scripts.js', array( 'jquery' ), '', true );	
	wp_enqueue_script( 'truvatour-custom', TRUVATOURTHEMEURI . 'js/custom.js', array( 'jquery' ), '', true );	
}
add_action( 'wp_enqueue_scripts', 'truvatour_scripts' );

function truvatour_styles_custom() {
	$custom_css = '';
	wp_enqueue_style('truvatour-custom-style', TRUVATOURTHEMEURI . 'css/custom_style.css');
	if( function_exists( 'ot_get_option' ) ):
    $custom_css = ot_get_option('custom_css');
	endif;
    wp_add_inline_style( 'truvatour-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'truvatour_styles_custom' );

function truvatour_styles_custom_banner() {
	wp_enqueue_style('truvatour-custom-banner-style', TRUVATOURTHEMEURI . 'css/custom_style_banner.css');
	$custom_css = '';
	$banner_image = '';
	
	$header_banner_type = get_post_meta(get_the_ID(), 'header_banner_type', true);
	if($header_banner_type == 'featured_image'):
		$banner_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
	endif;
	if($banner_image != ''){
    $custom_css .= ".transparent-parallax-title {
		background-image: url(".esc_url($banner_image).");
	}";    
    }
	
	$background_layout = (function_exists('ot_get_option'))? ot_get_option( 'background_layout', 'wide' ) : 'wide';
	if($background_layout == 'boxed'){
		$boxed_background_image = (function_exists('ot_get_option'))? ot_get_option( 'boxed_background_image', TRUVATOURTHEMEURI.'images/wood_03.png' ) : TRUVATOURTHEMEURI.'images/wood_03.png';
		$custom_css .='body.boxed{
			background: url('.esc_url($boxed_background_image).') repeat left center;
		}';
	}
	
	$custom_css .= truvatour_custom_css_from_theme_options();
    wp_add_inline_style( 'truvatour-custom-banner-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'truvatour_styles_custom_banner' );

function truvatour_custom_enqueue_script() {
	$custom_script = '';
   if( function_exists( 'ot_get_option' ) ):
   $custom_script = esc_js(ot_get_option( 'footer_scripts' ));
   endif;
   wp_add_inline_script( 'truvatour-custom-script', $custom_script );
}
add_action( 'wp_enqueue_scripts', 'truvatour_custom_enqueue_script' );
?>