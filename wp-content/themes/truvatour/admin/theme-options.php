<?php
//include theme options
include TRUVATOURTHEMEDIR . '/admin/theme-options/general.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/background.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/header.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/sidebar.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/footer.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/blog.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/typography.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/styling.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/customcss.php';
include TRUVATOURTHEMEDIR . '/admin/theme-options/woocommerce.php';
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'truvatour_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function truvatour_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  //available option functions - return type array()
  $general_options = truvatour_general_options();
  $background_options = truvatour_background_options();
  $header_options = truvatour_header_options();
  $sidebar_options = truvatour_sidebar_options();
  $footer_options = truvatour_footer_options();
  $blog_options = truvatour_blog_options();
  $typography_options = truvatour_typography_options();
  $styling_options = truvatour_styling_options();
  $custom_css = truvatour_custom_css();
  $woocommerce_options = truvatour_woocommerce_options();


  //merge all available options
  $settings = array_merge( $general_options, $background_options, $header_options, $sidebar_options, $footer_options, $blog_options, $typography_options, $styling_options, $custom_css, $woocommerce_options );

 

  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_options',
        'title'       => esc_html__( 'General Options', 'truvatour' )
      ),
      array(
        'id'          => 'background_options',
        'title'       => esc_html__( 'Background Options', 'truvatour' )
      ),
     array(
        'id'          => 'header_options',
        'title'       => esc_html__( 'Header Options', 'truvatour' )
      ),
      array(
        'id'          => 'footer_options',
        'title'       => esc_html__( 'Footer Options', 'truvatour' )
      ),
      array(
        'id'          => 'sidebar_option',
        'title'       => esc_html__( 'Sidebar Options', 'truvatour' )
      ),
      array(
        'id'          => 'blog_options',
        'title'       => esc_html__( 'Blog Options', 'truvatour' )
      ),
      array(
        'id'          => 'fonts',
        'title'       => esc_html__( 'Typography Options', 'truvatour' )
      ),
      array(
        'id'          => 'styling_options',
        'title'       => esc_html__( 'Styling Options', 'truvatour' )
      ),
      array(
        'id'          => 'custom_css',
        'title'       => esc_html__( 'Custom CSS', 'truvatour' )
      ),
      array(
        'id'          => 'wocommerce_options',
        'title'       => esc_html__( 'WooCommerce Options', 'truvatour' )
      )
    ),
    'settings'        => $settings
  );

  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;

  return $custom_settings[ 'settings' ];
  
}