<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 */
?>

            </section>
                        
            <?php $footer_widget_area = (function_exists('ot_get_option'))? ot_get_option('footer_widget_area', 'on') : 'on';
			$footer_widget_area_bottom = (function_exists('ot_get_option'))? ot_get_option('footer_widget_area_bottom', 'on') : 'on';
			if($footer_widget_area == 'on' || $footer_widget_area_bottom == 'on' ): ?>
                <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-bottom-1' ) ) : ?>
                <footer class="footer">
                    <div class="container">
                        <?php get_template_part('footer/footer-widget-area', ''); ?>
                        <?php get_template_part('footer/footer-widget-area-bottom', ''); ?>
                    </div><!-- end container -->
                </footer>
                <?php endif; ?>
            <?php endif; ?>
                    
            <div class="copyrights">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <?php                    
                                $copyright_text =  (function_exists('ot_get_option'))? ot_get_option( 'copyright_text', date('Y').'&copy; Copyright, TruvaTour, ThemeStall. All rights reserved.') : date('Y').'&copy; TruvaTour Tour INC. All rights reserved.';
                                echo wp_kses(do_shortcode($copyright_text), array('div'=>array('class'=>array(), 'id'=>array()), 'a'=>array('class'=>array(), 'title'=>array(), 'href'=>array()), 'p'=>array('class'=>array())));
                                ?>
                            
                        </div><!-- end col -->
    
                        <div class="col-md-6 text-right hidden-xs">                            
							<?php
							$extra_menu = '<li class="dmtop"><a href="#"><i class="fa fa-angle-up"></i></a></li>';							
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu',
                                    'menu_class' => 'list-inline',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s '.wp_kses($extra_menu, array('li'=>array('class'=>array()), 'a'=>array('href'=>array()), 'i'=>array('class'=>array()))).'</ul>',
                                    'container' => false,
                                    'fallback_cb'     => '',
									'depth'			=> 1
                                )
                            );
                            ?>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div>     
        </div><!-- end wrapper -->
        <?php wp_footer(); ?>  
	</body>
</html>