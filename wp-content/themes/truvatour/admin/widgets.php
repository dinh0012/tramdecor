<?php

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since TruvaTour 1.0
 */
function truvatour_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'truvatour' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'truvatour' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4><hr></div>',
	) );

	if( function_exists( 'ot_get_option' ) ):
		$sidebarArr = ot_get_option( 'create_sidebar', array() );
		if( !empty( $sidebarArr ) ){
			$i = 4;
			foreach ($sidebarArr as $sidebar) {

				register_sidebar( array(
					'name' => $sidebar['title'],
					'id' => 'sidebar-'.$i,
					'description' => $sidebar['desc'],
					'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4><hr></div>',
				) );
				$i++;
			}
		}
	endif;	//if( function_exists( 'ot_get_option' ) ):
	
	$footer_widget_area = (function_exists('ot_get_option'))? ot_get_option( 'footer_widget_area', 'on' ) : 'on';
	if( $footer_widget_area == 'on' ):
		$footer_widget_box = (function_exists('ot_get_option'))? ot_get_option( 'footer_widget_box', 3 ) : 3;
		for( $i = 1; $i <= $footer_widget_box; $i++ ):
			register_sidebar( array(
				'name' => sprintf(esc_html__( 'Footer Widget Area %d', 'truvatour' ), $i),
				'id' => 'footer-'.$i,
				'description' => sprintf(esc_html__( 'Appears in Footer column %d', 'truvatour' ), $i),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title"><h4>',
				'after_title' => '</h4><hr></div>',
			) );
		endfor; 
	endif;
	
	$footer_widget_area_bottom = (function_exists('ot_get_option'))? ot_get_option( 'footer_widget_area_bottom', 'on' ) : 'on';
	if( $footer_widget_area_bottom == 'on' ):
		register_sidebar( array(
			'name' => sprintf(esc_html__( 'Footer Widget Bottom Area', 'truvatour' )),
			'id' => 'footer-bottom-1',
			'description' => sprintf(esc_html__( 'Appears in Footer widget bottom area', 'truvatour' )),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4><hr></div>',
		) );
	endif;
}
add_action( 'widgets_init', 'truvatour_widgets_init' );
?>