<?php
// Register Style
function truvatour_admin_styles() {

	wp_register_style( 'truvatour-style', TRUVATOURTHEMEURI. 'admin/assets/css/style.css', false, '1.0.0', 'all' );
	wp_enqueue_style( 'truvatour-style' );
	
	wp_register_script( 'truvatour-scripts', TRUVATOURTHEMEURI. 'admin/assets/js/scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'truvatour-scripts' );

}

// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'truvatour_admin_styles' );