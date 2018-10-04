<?php
	if(is_page()) {
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
	else {
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

?>
	</div>
</div>

	<?php if( $layout != 'full' ): ?>
    
    <?php get_sidebar(); ?>
    
    <?php endif; // endif ?>
     
    </div>
    
</div>
<!-- Content Wrap -->