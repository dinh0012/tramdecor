<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage TruvaTour
 * @since TruvaTour 1.0.0
 */

if(is_page()){
	$sidebar = get_post_meta( get_the_ID(), 'sidebar', true );		
	if($sidebar == '') $sidebar = 'sidebar-1';
}
elseif(is_single()){
	$sidebar = (function_exists('ot_get_option'))? ot_get_option( 'blog_single_sidebar', 'sidebar-1' ) : 'sidebar-1';
}
else {
	$sidebar = (function_exists('ot_get_option'))? ot_get_option( 'blog_sidebar', 'sidebar-1' ) : 'sidebar-1';
}
?>
<?php if ( is_active_sidebar( $sidebar ) ) : ?>
<div id="sidebar" class="col-md-4 col-sm-12 col-xs-12">    
    <div class="sidebar">
		<div class="widget-area">
        	<?php dynamic_sidebar( $sidebar ); ?>
        </div>    
    </div>                
</div>	
<?php endif; ?>
