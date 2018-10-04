<?php
include(TRUVATOURTHEMEDIR . '/admin/scripts.php');
include(TRUVATOURTHEMEDIR . '/admin/truvatour-settings.php');

function truvatour_login_logo() { 
	$logo = (function_exists('ot_get_option'))? ot_get_option('admin_logo') : '';
	if($logo != ''){
	wp_enqueue_style('truvatour-custom-admin-style', TRUVATOURTHEMEURI . 'admin/assets/css/custom_admin_style.css');
    	
	$custom_css = "body.login div#login h1 a {
            background-image: url(".esc_url($logo).");
            background-position: bottom center;
			background-size: auto auto;
			margin: 0 auto 15px;
			width: auto;
        }";
	wp_add_inline_style( 'truvatour-custom-admin-style', $custom_css );
	}
}
add_action( 'login_enqueue_scripts', 'truvatour_login_logo' );

function truvatour_options_filter($var){
    $var = (is_array($var) && ($var['type'] == 'background') || ($var['type'] == 'upload') || ($var['type'] == 'measurement') || ($var['type'] == 'typography') || ($var['type'] == 'colorpicker') || ($var['type'] == 'colorpicker-opacity'));

     return $var;
}


function truvatour_custom_css_from_theme_options(){
	$custom_css = '';
	if( function_exists( 'ot_get_option' ) ):
    $settings = truvatour_theme_options();
    $options = array_filter($settings, "truvatour_options_filter");
    foreach ($options as $option) :
        if(isset($option['action'])){
            if( $option['type'] == 'background' ){
                $background = ot_get_option( $option['id'] );
                $background = (empty($background)) ? $option['std'] : $background;
                if( !empty($background) ){
                    foreach ($option['action'] as $value) {
                        if($value['selector'] != ''){
                            $custom_css .= $value['selector']. '{ ';
                            foreach( $background as $key => $value ){
                                if($key == 'background-image') $custom_css .= ($value != '')? $key. ': url('.esc_url($value).'); ' : '';
                                else $custom_css .= ($value != '')? $key. ': '.$value.'; ' : '';
                            }
                            $custom_css .= '}';
                        }
                    }
				}
			}
			elseif( $option['type'] == 'upload' ){
                $upload = ot_get_option( $option['id'] );
                $upload = ($upload == '') ? $option['std'] : $upload;
                if( $upload != '' ){
                    foreach ($option['action'] as $value) {
						if($value['property'] == 'cursor'){
							$custom_css .= ($value['selector'] != '')? $value['selector']. '{ '.$value['property'].': url('.esc_url($upload).'), auto; } ' : '';
						} else{
						$custom_css .= ($value['selector'] != '')? $value['selector']. '{ '.$value['property'].': url('.esc_url($upload).'); } ' : '';
						}
                    }
				}
			}
			
            elseif( $option['type'] == 'typography' ){
                $typography = ot_get_option( $option['id'], array() );        
                $typography = empty($typography) ? $option['std'] : $typography;
                if(!empty($typography)) {
                    foreach ($option['action'] as $value) {  
                        if($value['selector'] != ''){
                            $custom_css .= $value['selector']. '{ ';
                            foreach ($typography as $key => $value) {
                                if( $key == 'font-color' ) $custom_css .= 'color: '.$value.'; ';
                                else $custom_css .= ( $value != '' )? $key. ': '.$value.'; ' : '';
                            }
                            $custom_css .= ' }';
                        }
                    }
         
				}
			}
            elseif( $option[ 'type' ] == 'colorpicker' ){   
                $colorpicker = ot_get_option( $option['id'] );  

                $colorpicker = ($colorpicker == '') ? $option['std'] : $colorpicker;

                $rgb = truvatour_hex2rgb($colorpicker);

                if( $colorpicker != '' ){
                    foreach ($option['action'] as $value) {
                        $colorpicker = isset($value['opacity'])? 'rgba('.$rgb.', '.$value['opacity'].')' : $colorpicker;
                        $custom_css .= ($value['selector'] != '')?$value['selector']. '{ '.$value['property'].': '.$colorpicker .'; } ' : '';
                    }
				}
			}
				elseif( $option[ 'type' ] == 'colorpicker-opacity' ){  
                $colorpicker_opacity = ot_get_option( $option['id'] );  

                $colorpicker_opacity = ($colorpicker_opacity == '') ? $option['std'] : $colorpicker_opacity;

                if( $colorpicker_opacity != '' ){
                    foreach ($option['action'] as $value) {
                        $custom_css .= ($value['selector'] != '')? $value['selector']. '{ '.$value['property'].': '.$colorpicker_opacity .'; } ' : '';
                    }
				}
		    }
            elseif( $option[ 'type' ] == 'measurement' ){ 
                $measurement =  ot_get_option( $option['id'], array() ); 
                $measurement = empty($measurement) ? $option['std'] : $measurement; 
                if( !empty( $measurement ) ) {
                    foreach ($option['action'] as $value) {  
                        if($value['selector'] != ''){
                            $custom_css .= $value['selector']. '{ ';
                            $custom_css .= $value['property'].': '.intval($measurement[0]).$measurement[1] .';';
                            $custom_css .= ' }';
                        }
                    }
				}
			}
        }//if(isset($option['action'])):
    endforeach;
	endif;
	return $custom_css;
}


function truvatour_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   $rgb_color = implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb_color;
}

add_filter('siteorigin_panels_row_style_fields', 'truvatour_panels_layout_style_groups');
function truvatour_panels_layout_style_groups($groups){
  $groups['overlay'] = array(
            'name' => esc_html__('Background Overlay', 'truvatour'),
            'type' => 'color',
            'group' => 'design',
            'description' => esc_html__('Background Overlay', 'truvatour'),
			'priority' => 15,
        );
	$groups['opacity'] = array(
            'name' => esc_html__('Background Opacity', 'truvatour'),
            'type' => 'select',
            'group' => 'design',
            'description' => esc_html__('Background Opacity', 'truvatour'),
			'priority' => 20,
			'options' => array(
				'' => esc_html__('--', 'truvatour'),
				'0.1' => esc_html__('0.1', 'truvatour'),
				'0.2' => esc_html__('0.2', 'truvatour'),
				'0.3' => esc_html__('0.3', 'truvatour'),
				'0.4' => esc_html__('0.4', 'truvatour'),
				'0.5' => esc_html__('0.5', 'truvatour'),
				'0.6' => esc_html__('0.6', 'truvatour'),
				'0.7' => esc_html__('0.7', 'truvatour'),
				'0.8' => esc_html__('0.8', 'truvatour'),
				'0.9' => esc_html__('0.9', 'truvatour'),
			),
        );
  return $groups;
}

add_filter('siteorigin_panels_row_style_attributes', 'truvatour_row_style_attributes', 10, 2);

function truvatour_row_style_attributes($attributes, $args){
	// Add the panel layout wrapper
	if( !empty( $args['overlay'] ) ) {
		$rgba = truvatour_hex2rgb($args['overlay']);
		$attributes['data-overlay'] = $rgba;
	}
	if( !empty( $args['opacity'] ) ) {
		$attributes['data-opacity'] = $args['opacity'];
	}	
	return $attributes;
}