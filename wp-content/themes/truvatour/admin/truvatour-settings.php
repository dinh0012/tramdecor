<?php
/**
 * Initialize the meta boxes. 
 */

add_action( 'admin_init', 'truvatour_meta_boxes' );

function truvatour_meta_boxes() {
  if( function_exists( 'ot_get_option' ) ): 
  $my_meta_box = array(
    'id'        => 'truvatour_meta_box',
    'title'     => esc_html__('TruvaTour Page Settings', 'truvatour'),
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
	  array(
        'id'          => 'header_settings',
        'label'       => esc_html__('Header Settings', 'truvatour'),      
        'type'        => 'tab',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'custom_title',
        'label'       => esc_html__('Custom Title', 'truvatour'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'class'       => '',
        'choices'     => array(),
        'condition'	  => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'title',
        'label'       => esc_html__('Title', 'truvatour'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array(),
        'operator'    => 'and',
        'condition'	  => 'custom_title:is(on)'
      ),
      array(
        'id'          => 'subtitle',
        'label'       => esc_html__('Sub Title', 'truvatour'),
        'desc'        => '',
        'std'         => 'TruvaTour subtitle goes here',
        'type'        => 'text',
        'class'       => '',
        'rows'		  => 3,
        'choices'     => array(),
        'operator'    => 'and',
        'condition'	  => 'custom_title:is(on)'
      ),
	   array(
        'id'          => 'content_tab',
        'label'       => esc_html__('Layout Settings', 'truvatour'),      
        'type'        => 'tab',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_layout',
        'label'       => esc_html__( 'Default Layout', 'truvatour' ),
        'desc'        => '',
        'std'         => 'full',
        'type'        => 'radio-image',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => esc_html__( 'Full Width', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => esc_html__( 'With Left Sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => esc_html__( 'With Right sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/right-sidebar.png'
          ),
        )
      ),
      array(
        'id'          => 'sidebar',
        'label'       => esc_html__('Select Sidebar', 'truvatour'),
        'desc'        => '',
        'std'         => 'sidebar-1',
        'type'        => 'sidebar-select',
        'class'       => '',
        'choices'     => array(),
        'operator'    => 'and',
        'condition'   => 'page_layout:not(full)'
      ),
	  array(
        'id'          => 'header_banner_type',
        'label'       => esc_html__( 'Header Banner Type', 'truvatour' ),
        'desc'        => esc_html__( 'Select your header banner type', 'truvatour' ),
        'std'         => 'bg_color',
        'type'        => 'select',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'bg_color',
            'label'       => esc_html__( 'Default', 'truvatour' ),
          ),
		  array(
            'value'       => 'featured_image',
            'label'       => esc_html__( 'Background Featured Image', 'truvatour' ),
          ),
		  array(
            'value'       => 'bg_shortcode',
            'label'       => esc_html__( 'Custom Shortcode', 'truvatour' ),
          )
        )
      ),
	  array(
        'id'          => 'header_custom_shortcode',
        'label'       => esc_html__('Header Custom Shortcode', 'truvatour'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'class'       => '',
        'choices'     => array(),
        'operator'    => 'and',
        'condition'   => 'header_banner_type:is(bg_shortcode)'
      ),
    )
  );
  
  ot_register_meta_box( $my_meta_box );
  endif;  //if( function_exists( 'ot_get_option' ) ):
}
?>