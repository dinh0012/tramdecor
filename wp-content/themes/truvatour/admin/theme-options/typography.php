<?php
function truvatour_typography_options( $options = array() ){    
    $options = array(     
		array( // Google Font API
            'id'          => 'google_fonts',
            'label'       => esc_html__('Google Fonts.', 'truvatour'),
            'desc'        => esc_html__('You can add multiple google fonts and set it to any tag.', 'truvatour'),
            'std'         => array( 
			  array(
				'family'    => 'Roboto',
				'variants'  => array( '400', '700' ),
				'subsets'   => array( 'latin' )
			  ),
			),
            'type'        => 'google-fonts',
            'section'     => 'fonts',
            'class'       => ''
        ),
		array(
        'id'          => 'body',
        'label'       => esc_html__( 'Body &amp; Content p', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'selector'    => 'body, p', 
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector' => 'body, body p',
                'property'   => ''
                ),
            )         
      ),
      array(
        'id'          => 'body_a',
        'label'       => esc_html__( 'Body a', 'truvatour' ),
        'desc'        => '',
        'std'         => '',         
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'body a, p a', 
                'property'   => ''
                ),
            )
      ),
      array(
        'id'          => 'menu_a',
        'label'       => esc_html__( 'Menu a', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => '.navbar-nav > li > a', 
                'property'   => ''
                ),
            )
      ),
      array(
        'id'          => 'submenu_a',
        'label'       => esc_html__( 'Submenu a', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => '.truvatour-dd a,.truvatour-mm a', 
                'property'   => ''
                ),
            )
      ),
      array(
        'id'          => 'h1',
        'label'       => esc_html__( 'H1', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'selector'    => 'h1',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'h1',
                'property'   => ''
                ),
            ) 
      ),
      array(
        'id'          => 'h2',
        'label'       => esc_html__( 'H2', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'selector'    => 'h2',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'h2',
                'property'   => ''
                ),
            ) 
      ),
      array(
        'id'          => 'h3',
        'label'       => esc_html__( 'H3', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'selector'    => 'h3',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'h3',
                'property'   => ''
                ),
            ) 
      ),
      array(
        'id'          => 'h4',
        'label'       => esc_html__( 'H4', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'selector'    => 'h4',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'h4',
                'property'   => ''
                ),
            ) 
      ),
      array(
        'id'          => 'h5',
        'label'       => esc_html__( 'H5', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                    'selector'    => 'h5',
                    'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'h6',
        'label'       => esc_html__( 'H6', 'truvatour' ),
        'desc'        => '',
        'std'         => '',        
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => 'h6',
                'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'sidebar_fonts',
        'label'       => esc_html__( 'Sidebar typography options', 'truvatour' ),
        'desc'        => esc_html__( 'Only Applied on sidebar widget area', 'truvatour' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => '.main-sidebar',
                'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'sidebar_title',
        'label'       => esc_html__( 'Sidebar Title', 'truvatour' ),
        'desc'        => '',
        'std'         => '',        
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => '.main-sidebar .widget-title',
                'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'sidebar_p',
        'label'       => esc_html__( 'Sidebar p', 'truvatour' ),
        'desc'        => '',
        'std'         => '',                
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
		'action'      => array(
                array(
                'selector'    => '.main-sidebar p',
                'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'sidebar_link',
        'label'       => esc_html__( 'Sidebar Link', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                'selector'    => '.main-sidebar a',
                'property'   => ''
                ),
            ) 
      ),
      array(
        'id'          => 'footer_typography_option',
        'label'       => esc_html__( 'Footer Typography option', 'truvatour' ),
        'desc'        => esc_html__( 'Only applied on footer.', 'truvatour' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_p',
        'label'       => esc_html__( 'Footer p', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                    'selector'    => '.footer-widget-wrap p, .copyrights p,.subfooter p',
                    'property'   => ''
                ),
            ),
      ),
      array(
        'id'          => 'footer_link',
        'label'       => esc_html__( 'Footer Link', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'action'      => array(
                array(
                    'selector'    => '.footer-widget-wrap a, .copyrights a,.subfooter a',
                    'property'   => ''
                ),
            ),
      ),
    );

	return apply_filters( 'truvatour_typography_options', $options );
}   
?>