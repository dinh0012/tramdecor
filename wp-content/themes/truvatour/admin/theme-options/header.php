<?php
function truvatour_header_options( $options = array() ){
	$options = array(
	  array(
        'id'          => 'header_top_bar',
        'label'       => esc_html__( 'Display Header Top Bar', 'truvatour' ),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'search_icon_in_menu',
        'label'       => esc_html__( 'Display Search Icon in Header Menu', 'truvatour' ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'login_button_in_menu',
        'label'       => esc_html__( 'Display Login Button in Header', 'truvatour' ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_login_page',
        'label'       => esc_html__( 'Login Page', 'truvatour' ),
        'desc'        => esc_html__( 'create a page and insert login shortcode and set it as login page.', 'truvatour' ),
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'login_button_in_menu:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_top_contact_link',
        'label'       => esc_html__( 'Header Top Contact', 'truvatour' ),
        'desc'        => esc_html__( 'Header top contact link', 'truvatour' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_top_time',
        'label'       => esc_html__( 'Header Top Time', 'truvatour' ),
        'desc'        => esc_html__( 'Header top time', 'truvatour' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_top_phone',
        'label'       => esc_html__( 'Header Top Phone', 'truvatour' ),
        'desc'        => esc_html__( 'Header top phone', 'truvatour' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'show_breadcrumbs',
        'label'       => esc_html__( 'Display Breadcrumbs', 'truvatour' ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'bredcrumb_menu_prefix',
        'label'       => esc_html__( 'Breadcrumb Prefix', 'truvatour' ),
        'desc'        => esc_html__( 'Breadcrumb prefix', 'truvatour' ),
        'std'         => 'Home',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'show_breadcrumbs:not(off)',
        'operator'    => 'and'
      ),
	);
	return apply_filters( 'truvatour_header_options', $options );
} 
?>