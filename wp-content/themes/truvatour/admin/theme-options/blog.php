<?php
function truvatour_blog_options( $options = array() ){
	$options = array(
	array(
        'id'          => 'blog_style',
        'label'       => esc_html__( 'Blog Style', 'truvatour' ),
        'desc'        => esc_html__( 'Select blog style', 'truvatour' ),
        'std'         => 'default',
        'type'        => 'select',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
		  array(
            'value'       => 'default',
            'label'       => esc_html__( 'Default View', 'truvatour' ),
          ),
          array(
            'value'       => 'list_view',
            'label'       => esc_html__( 'List View', 'truvatour' ),
          ),
		  array(
            'value'       => 'grid_view',
            'label'       => esc_html__( 'Grid View', 'truvatour' ),
          )
        )
      ),
	array(
        'id'          => 'blog_title',
        'label'       => esc_html__( 'Blog Header Title', 'truvatour' ),
        'desc'        => esc_html__( 'Blog page header title', 'truvatour' ),
        'std'         => 'TruvaTour Blog',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'blog_subtitle',
        'label'       => esc_html__( 'Blog Header Sub-Title', 'truvatour' ),
        'desc'        => esc_html__( 'Blog page header sub-title', 'truvatour' ),
        'std'         => 'A basic standard blog page example.',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		array(
        'id'          => 'blog_layout',
        'label'       => esc_html__( 'Blog layout', 'truvatour' ),
        'desc'        => esc_html__( 'Blog layout for blog page', 'truvatour' ),
        'std'         => 'rs',
        'type'        => 'radio-image',
        'section'     => 'blog_options',
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
            'label'       => esc_html__( 'Full width', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => esc_html__( 'Left sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => esc_html__( 'Right sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/right-sidebar.png'
          )
        )
      ),
      array(
        'id'          => 'blog_sidebar',
        'label'       => esc_html__( 'Blog Sidebar', 'truvatour' ),
        'desc'        => esc_html__( 'Select your blog sidebar', 'truvatour' ),
        'std'         => 'sidebar-1',
        'type'        => 'sidebar-select',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'blog_layout:not(full)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_layout',
        'label'       => esc_html__( 'Blog single post layout', 'truvatour' ),
        'desc'        => esc_html__( 'Blog single post layout', 'truvatour' ),
        'std'         => 'rs',
        'type'        => 'radio-image',
        'section'     => 'blog_options',
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
            'label'       => esc_html__( 'Full width', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => esc_html__( 'Left sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => esc_html__( 'Right sidebar', 'truvatour' ),
            'src'         => OT_URL . '/assets/images/layout/right-sidebar.png'
          )
        )
      ),
    array(
        'id'          => 'blog_single_sidebar',
        'label'       => esc_html__( 'Single post Sidebar', 'truvatour' ),
        'desc'        => esc_html__( 'Single post sidebar', 'truvatour' ),
        'std'         => 'sidebar-1',
        'type'        => 'sidebar-select',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_layout:not(full)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sticky_post_text',
        'label'       => esc_html__( 'Sticky post text', 'truvatour' ),
        'desc'        => esc_html__( 'Sticky post text', 'truvatour' ),
        'std'         => 'Featured',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'excerpt_length',
        'label'       => esc_html__( 'Excerpt Length', 'truvatour' ),
        'desc'        => esc_html__( 'Excerpt Length', 'truvatour' ),
        'std'         => '20',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    );

	return apply_filters( 'truvatour_blog_options', $options );
}  
?>