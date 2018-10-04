<?php
	if(is_page()){
		$layout = get_post_meta( get_the_ID(), 'page_layout', true );
		if($layout != ''){
			$layout = $layout;
		} else {
			$layout = 'full';
		}
	}
	
	elseif(is_single()){
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'single_layout', 'rs' ) : 'rs';
	}
	else{
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'blog_layout', 'rs' ) : 'rs';
	}
	
	if(class_exists( 'bbPress' )){
		if(is_bbpress()){	
		$layout = (function_exists('ot_get_option'))? ot_get_option( 'forums_layout', 'full' ) : 'full';
		}
	}
	
	if(is_author()){
		$layout = 'full';
	}
	
	if ( class_exists( 'woocommerce' ) ){
		if( is_product() ){
			$layout = 'full';
		}
		elseif( is_woocommerce() ){
			$layout = 'full';
		}
	}
	
	if( $layout == 'full' ){
		$container_class = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
	}
	else{
		$container_class = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
		$container_class .= ( $layout == 'ls' )? ' pull-right' : '';
	}
?>

<div class="container">    
    <div class="row">    
    	<div class="<?php echo esc_attr($container_class); ?>">
        	<div class="content">
