<?php
function truvatour_woocommerce_options( $options = array() ){
	$options = array(
        array(
            'id'          => 'product_column',
            'label'       => esc_html__( 'Product column', 'truvatour' ),
            'desc'        => '',
            'std'         => '3',
            'type'        => 'numeric-slider',
            'section'     => 'wocommerce_options',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '1,4,1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
		array(
            'id'          => 'related_product',
            'label'       => esc_html__( 'Related product show in single product', 'truvatour' ),
            'desc'        => '',
            'std'         => '3',
            'type'        => 'numeric-slider',
            'section'     => 'wocommerce_options',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '1,9,1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
		array(
            'id'          => 'related_product_column',
            'label'       => esc_html__( 'Related Product column', 'truvatour' ),
            'desc'        => '',
            'std'         => '3',
            'type'        => 'numeric-slider',
            'section'     => 'wocommerce_options',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '1,4,1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
	  array(
        'id'          => 'shop_page_title',
        'label'       => esc_html__( 'Shop Title', 'truvatour' ),
        'desc'        => esc_html__( 'Shop page title', 'truvatour' ),
        'std'         => 'TruvaTour Shop',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'shop_subtitle',
        'label'       => esc_html__( 'Shop Sub-Title', 'truvatour' ),
        'desc'        => esc_html__( 'Shop page Sub title', 'truvatour' ),
        'std'         => 'TruvaTour subtitle goes here',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'shop_single_title',
        'label'       => esc_html__( 'Shop Single Title', 'truvatour' ),
        'desc'        => esc_html__( 'Shop single page title', 'truvatour' ),
        'std'         => 'TruvaTour Shop',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'shop_single_subtitle',
        'label'       => esc_html__( 'Shop Single Sub-Title', 'truvatour' ),
        'desc'        => esc_html__( 'Shop single page Sub title', 'truvatour' ),
        'std'         => 'TruvaTour subtitle goes here',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'add_to_cart_button_text',
        'label'       => esc_html__( 'Add to Cart Button Text', 'truvatour' ),
        'desc'        => esc_html__( 'Text of add to cart', 'truvatour' ),
        'std'         => 'BOOK NOW',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'sidebar_widget_text_title',
        'label'       => esc_html__( 'Sidebar Title', 'truvatour' ),
        'desc'        => esc_html__( 'Sidebar title in single shop page', 'truvatour' ),
        'std'         => 'Book Now',
        'type'        => 'text',
        'section'     => 'wocommerce_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    );

	return apply_filters( 'truvatour_woocommerce_options', $options );
}  
?>