<?php
function truvatour_general_options( $options = array() ){
	
	$options = array(
	  array(
        'id'          => 'main_logo',
        'label'       => esc_html__( 'Header Logo', 'truvatour' ),
        'desc'        => esc_html__( 'Header logo', 'truvatour' ),
        'std'         => TRUVATOURTHEMEURI. 'images/logo.png',
        'type'        => 'upload',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'main_logo_alt',
        'label'       => esc_html__( 'Header Logo Alt', 'truvatour' ),
        'desc'        => esc_html__( 'Header logo Alternative', 'truvatour' ),
        'std'         => TRUVATOURTHEMEURI. 'images/logo-white.png',
        'type'        => 'upload',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'admin_logo',
        'label'       => esc_html__( 'Admin Logo', 'truvatour' ),
        'desc'        => esc_html__( 'Admin login logo', 'truvatour' ),
        'std'         => TRUVATOURTHEMEURI. 'images/logo.png',
        'type'        => 'upload',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'preloader',
        'label'       => esc_html__( 'Preloader Image', 'truvatour' ),
        'desc'        => esc_html__( 'Preloder image', 'truvatour' ),
        'std'         => TRUVATOURTHEMEURI. 'images/loader.gif',
        'type'        => 'upload',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	);

	return apply_filters( 'truvatour_general_options', $options );
}
?>