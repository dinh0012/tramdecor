<?php
if( !class_exists( 'TPLfrontEnd' ) ) :

	class TPLfrontEnd {

        function __construct(){
            add_action( 'wp_enqueue_scripts', array($this, 'tlp_front_end') );
            add_action( 'wp_head', array($this, 'custom_css') );
        }

        function custom_css(){
            $html = null;
            global $TLPteam;
            $settings = get_option($TLPteam->options['settings']);
            $pc = (isset($settings['primary_color']) ? ($settings['primary_color'] ? $settings['primary_color'] : '#0367bf' ) : '#0367bf');
            $html .= "<style type='text/css'>";
            $html .= '.tlp-team .short-desc, .tlp-team .tlp-team-isotope .tlp-content, .tlp-team .button-group .selected, .tlp-team .layout1 .tlp-content, .tlp-team .tpl-social a, .tlp-team .tpl-social li a.fa {';
                $html .= 'background: '.$pc;
            $html .= '}';

            $html .= (isset($settings['custom_css']) ? ($settings['custom_css'] ? "{$settings['custom_css']}" : null) : null );

            $html .= "</style>";
             echo $html;
        }

	function tlp_front_end(){
            global $TLPteam;
            wp_enqueue_style( 'tlp-fontawsome', $TLPteam->assetsUrl .'vendor/font-awesome/css/font-awesome.min.css' );
            wp_enqueue_style( 'tlp-team-owl-carousel', $TLPteam->assetsUrl . 'vendor/owl-carousel/assets/owl.carousel.min.css', '', TLP_TEAM_VERSION );
            wp_enqueue_style( 'tlpstyle', $TLPteam->assetsUrl . 'css/tlpstyle.css', '', TLP_TEAM_VERSION );
            wp_enqueue_script( 'tpl-team-isotope-js', $TLPteam->assetsUrl . 'vendor/isotope/isotope.pkgd.min.js', array('jquery', 'imagesloaded'), TLP_TEAM_VERSION, true);
            wp_enqueue_script( 'tlp-team-owl-carousel', $TLPteam->assetsUrl . 'vendor/owl-carousel/owl.carousel.min.js', array('jquery', 'imagesloaded'), TLP_TEAM_VERSION, true);
            wp_enqueue_script( 'tpl-team-front-end', $TLPteam->assetsUrl . 'js/front-end.js', array('jquery'), TLP_TEAM_VERSION, true);
        }

	}
endif;
