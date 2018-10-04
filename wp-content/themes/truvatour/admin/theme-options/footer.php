<?php
function truvatour_footer_options( $options = array() ){
	$options = array(
	  array(
        'id'          => 'footer_widget_area',
        'label'       => esc_html__( 'Footer widget area', 'truvatour' ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_widget_box',
        'label'       => esc_html__( 'Footer widget box', 'truvatour' ),
        'desc'        => '',
        'std'         => '3',
        'type'        => 'numeric-slider',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,4,1',
        'class'       => '',
        'condition'   => 'footer_widget_area:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_widget_area_bottom',
        'label'       => esc_html__( 'Footer widget bottom area', 'truvatour' ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'copyright_text',
        'label'       => esc_html__( 'Copyright Text', 'truvatour' ),
        'desc'        => '',
        'std'         => 'Copyrights &copy; '.date('Y').' <a href="#">ThemeStall</a> All Rights Reserved.',
        'type'        => 'textarea',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_scripts',
        'label'       => esc_html__( 'Footer scripts', 'truvatour' ),
        'desc'        => esc_html__( 'Custom script add footer part', 'truvatour' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer_options',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    );

	return apply_filters( 'truvatour_footer_options', $options );
}  
?>