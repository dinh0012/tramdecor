<?php
function truvatour_background_options( $options = array() ){
	$options = array(
	  array(
        'id'          => 'background_layout',
        'label'       => esc_html__( 'Background Layout', 'truvatour' ),
        'desc'        => esc_html__( 'Background Layout', 'truvatour' ),
        'std'         => 'wide',
        'type'        => 'select',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'wide',
            'label'       => esc_html__( 'Wide', 'truvatour' ),
          ),
          array(
            'value'       => 'boxed',
            'label'       => esc_html__( 'Boxed', 'truvatour' ),
          )
        )
      ),
	  array(
        'id'          => 'boxed_background_image',
        'label'       => esc_html__( 'Boxed Background Image', 'truvatour' ),
        'desc'        => esc_html__( 'Boxed background image', 'truvatour' ),
        'std'         => TRUVATOURTHEMEURI.'images/wood_03.png',
        'type'        => 'upload',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'background_layout:is(boxed)',
        'operator'    => 'and'
      ),
		array(
        'id'          => 'container_width',
        'label'       => esc_html__( 'Container width', 'truvatour' ),
        'desc'        => esc_html__( 'Main container width', 'truvatour' ),
        'std'         => array(1170, 'px'),
        'type'        => 'measurement',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      =>array(
                array(
                    'selector' => '.container',
                    'property' => 'max-width'
                    )
            )
      ),
      array(
        'id'          => 'body_background',
        'label'       => esc_html__( 'Body background', 'truvatour' ),
        'desc'        => esc_html__( 'Background can be image or color', 'truvatour' ),
        'std'         => array(),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => 'body'
                    )
            )
      ),
      array(
        'id'          => 'main_container_background',
        'label'       => esc_html__( 'Main container background', 'truvatour' ),
        'desc'        => esc_html__( 'Background can be image or color', 'truvatour' ),
        'std'         => array(),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.container'
                    )
            )
      ),
    array(
        'id'          => 'sidebar_background',
        'label'       => esc_html__( 'Sidebar background', 'truvatour' ),
        'desc'        => esc_html__( 'Sidebar Background', 'truvatour' ),
        'std'         => array('background-image' => '', 'background-color' => ''),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.sidebar'
                    )
            )
      ),
	  array(
        'id'          => 'sticky_menu_background',
        'label'       => esc_html__( 'Sticky Menu background', 'truvatour' ),
        'desc'        => esc_html__( 'Sticky menu background', 'truvatour' ),
        'std'         => array('background-image' => '', 'background-color' => ''),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.transparent-header .header.affix'
                    )
            )
      ),
	  array(
        'id'          => 'header_banner_background',
        'label'       => esc_html__( 'Header Banner background', 'truvatour' ),
        'desc'        => esc_html__( 'Header banner background', 'truvatour' ),
        'std'         => array('background-image' => '', 'background-color' => ''),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.page-title1.little-pad'
                    )
            )
      ),
	  array(
        'id'          => 'footer_widget_background',
        'label'       => esc_html__( 'Footer Widget background', 'truvatour' ),
        'desc'        => esc_html__( 'Footer Widget background', 'truvatour' ),
        'std'         => array('background-image' => '', 'background-color' => ''),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.footer'
                    )
            )
      ),
	  array(
        'id'          => 'footer_copyright_background',
        'label'       => esc_html__( 'Footer Copyright background', 'truvatour' ),
        'desc'        => esc_html__( 'Footer Copyright background', 'truvatour' ),
        'std'         => array('background-image' => '', 'background-color' => ''),
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'   => array(
                array(
                    'selector' => '.copyrights'
                    )
            )
      ),    
    );

	return apply_filters( 'truvatour_background_options', $options );
}  
?>