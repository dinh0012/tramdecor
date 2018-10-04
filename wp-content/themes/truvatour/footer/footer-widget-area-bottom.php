<?php
/**
 * footer widget area
 *
 *
 * @package WordPress
 * @subpackage truvatour
 * @since truvatour 1.0
 */
?>
<?php
	$footer_widget_area_bottom = (function_exists('ot_get_option'))? ot_get_option('footer_widget_area_bottom', 'on') : 'on';	
	if( $footer_widget_area_bottom == 'on' ):
		?>
        <?php if ( is_active_sidebar( 'footer-bottom-1' ) ) : ?>
        <hr>     
        <div class="footer-widget-bottom-content">			
            	<?php dynamic_sidebar( 'footer-bottom-1' ); ?>
            <?php endif; ?>                           
        </div>
    <?php endif; ?>