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
	$footer_widget_area = (function_exists('ot_get_option'))? ot_get_option('footer_widget_area', 'on') : 'on';	
	if( $footer_widget_area == 'on' ):
		$footer_widget_box = (function_exists('ot_get_option'))? ot_get_option('footer_widget_box', 3) : 3;	
		$col_class = 12/$footer_widget_box;		
		?>
        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )) : ?>     
        <div class="row">
			<?php
            for( $i = 1; $i <= $footer_widget_box; $i++ ): ?>                    
				<?php if ( is_active_sidebar( 'footer-'.$i ) ) : ?>
                <div class="col-md-<?php echo esc_attr($col_class); ?> col-sm-<?php echo esc_attr($col_class); ?> footer-widget-area">
                <?php dynamic_sidebar( 'footer-'.$i ); ?>
                </div>
                <?php
                endif;
                ?>            
                <?php
            endfor;
             ?>                
        </div>
    <?php endif; ?>
	<?php endif; ?>