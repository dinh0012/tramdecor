<?php
/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Theme_Options' ) ) {

    class WPEX_Theme_Options {

        /**
         * Start things up
         *
         * @since 1.0.0
         */
        public function __construct() {

            // We only need to register the admin panel on the back-end
            if ( is_admin() ) {
                add_action( 'admin_menu', array( 'WPEX_Theme_Options', 'add_admin_menu' ) );
                add_action( 'admin_init', array( 'WPEX_Theme_Options', 'register_settings' ) );
            }

        }

        /**
         * Returns all theme options
         *
         * @since 1.0.0
         */
        public static function get_theme_options() {
            return get_option( 'theme_options' );
        }

        /**
         * Returns single theme option
         *
         * @since 1.0.0
         */
        public static function get_theme_option( $id ) {
            $options = self::get_theme_options();
            if ( isset( $options[$id] ) ) {
                return $options[$id];
            }
        }

        /**
         * Add sub menu page
         *
         * @since 1.0.0
         */
        public static function add_admin_menu() {
            add_menu_page(
                esc_html__( 'Theme Options', 'text-domain' ),
                esc_html__( 'Theme Options', 'text-domain' ),
                'manage_options',
                'theme-settings',
                array( 'WPEX_Theme_Options', 'create_admin_page' )
            );
        }

        /**
         * Register a setting and its sanitization callback.
         *
         * We are only registering 1 setting so we can store all options in a single option as
         * an array. You could, however, register a new setting for each option
         *
         * @since 1.0.0
         */
        public static function register_settings() {
            register_setting( 'theme_options', 'theme_options', array( 'WPEX_Theme_Options', 'sanitize' ) );
        }

        /**
         * Sanitization callback
         *
         * @since 1.0.0
         */
        public static function sanitize( $options ) {

            // If we have options lets sanitize them
            if ( $options ) {

                // Checkbox
                if ( ! empty( $options['checkbox_example'] ) ) {
                    $options['checkbox_example'] = 'on';
                } else {
                    unset( $options['checkbox_example'] ); // Remove from options if not checked
                }

                // Input
                if ( ! empty( $options['input_example'] ) ) {
                    $options['input_example'] = sanitize_text_field( $options['input_example'] );
                } else {
                    unset( $options['input_example'] ); // Remove from options if empty
                }

                // Select
                if ( ! empty( $options['select_example'] ) ) {
                    $options['select_example'] = sanitize_text_field( $options['select_example'] );
                }

            }

            // Return sanitized options
            return $options;

        }

        /**
         * Settings page output
         *
         * @since 1.0.0
         */
        public static function create_admin_page() { ?>

            <div class="wrap redux-main " >

                <h1><?php esc_html_e( 'Theme Options', 'text-domain' ); ?></h1>

                <form method="post" action="options.php">

                    <?php settings_fields( 'theme_options' ); ?>

                    <table class="form-table wpex-custom-admin-login-table">
                        <?php echo self::linkSocial(); ?>
                        <?php echo self::uploadLogo(); ?>
                        <?php echo self::textOnBannerOnTop(); ?>
                        <?php echo self::btnOnBannerOnTop(); ?>

                    </table>

                    <?php submit_button(); ?>

                </form>

            </div><!-- .wrap -->
        <?php }

        public static function linkSocial() {
            $socialLink =  WPEX_Theme_Options::get_theme_option('top_bar_right_social_icons');
            $html ='';
            $html .= '<tr class="fold"><th scope="row">';
            $html .=  '<div class="redux_field_th">Social Icons<span class="description"> Enter the full URL to your social profile</span></div></th>';
            $html .=  '<td>';
            $html .=  '<fieldset id="theme_options-top_bar_right_social_icons" class="redux-field-container redux-field redux-container-sortable" data-id="top_bar_right_social_icons" data-type="sortable">';
            $html .=  '<ul id="top_bar_right_social_icons-list" class="redux-sortable   labeled ui-sortable">';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[facebook]"><strong>facebook</strong></label><br>';
            $html .=  '<input rel="top_bar_right_social_icons-facebook-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][facebook]" id="top_bar_right_social_icons[facebook]" value="' .  $socialLink['facebook'] . '" placeholder="Facebook"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[youtube]"><strong>youtube</strong></label><br><input rel="top_bar_right_social_icons-youtube-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][youtube]" id="top_bar_right_social_icons[youtube]" value="' .  $socialLink['youtube'] . '" placeholder="Youtube"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[instagram]"><strong>instagram</strong></label><br><input rel="top_bar_right_social_icons-instagram-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][instagram]" id="top_bar_right_social_icons[instagram]" value="' .  $socialLink['instagram'] . '" placeholder="Instagram"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[linkedin]"><strong>linkedin</strong></label><br><input rel="top_bar_right_social_icons-linkedin-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][linkedin]" id="top_bar_right_social_icons[linkedin]" value="' .  $socialLink['linkedin'] . '" placeholder="Linkedin"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[twitter]"><strong>twitter</strong></label><br><input rel="top_bar_right_social_icons-twitter-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][twitter]" id="top_bar_right_social_icons[twitter]" value="' .  $socialLink['twitter'] . '" placeholder="Twitter"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[skype]"><strong>skype</strong></label><br><input rel="top_bar_right_social_icons-skype-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][skype]" id="top_bar_right_social_icons[skype]" value="' .  $socialLink['skype'] . '" placeholder="Skype"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[pinterest]"><strong>pinterest</strong></label><br><input rel="top_bar_right_social_icons-pinterest-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][pinterest]" id="top_bar_right_social_icons[pinterest]" value="' .  $socialLink['pinterest'] . '" placeholder="Pinterest"></li>';
            $html .=  '<li><label class="bugger" for="top_bar_right_social_icons[vimeo]"><strong>vimeo</strong></label><br><input rel="top_bar_right_social_icons-vimeo-hidden" class="regular-text " type="text" name="theme_options[top_bar_right_social_icons][vimeo]" id="top_bar_right_social_icons[vimeo]" value="' .  $socialLink['vimeo'] . '" placeholder="Vimeo"></li>';
            $html .=  '</ul></fieldset></td></tr>';
            return $html;
        }

        public static function uploadLogo()
        {
            $logo = WPEX_Theme_Options::get_theme_option('logo');
            $logoId = WPEX_Theme_Options::get_theme_option('logId');
            $html = '';
            $html .= '<tr class="fold"><th scope="row">';
            $html .= '<div class="redux_field_th">Upload Logo<span class="description"> Upload Logo</span></div></th>';
            $html .= '<td>';
            $html .= '<fieldset id="theme_options-top_bar_right_social_icons" class="redux-field-container redux-field redux-container-sortable" data-id="top_bar_right_social_icons" data-type="sortable">';

            $html .= '<div class="screenshot">
                         <a class="of-uploaded-image" href="' . $logo . '" target="_blank">
                         <img class="redux-option-image" id="image_banner" src="' . $logo . '" alt="" target="_blank" rel="external"></a>
                      </div>';
            $html .= '<div class="upload_button_div">
                        <span class="button media_upload_button" id="banner_image-media">Upload</span>
                      </div>';
            $html .= '<input type="hidden" name="theme_options[logoId]" id="myprefix_image_id" value="' . $logoId . '" class="regular-text" />';
            $html .= '<input type="hidden" name="theme_options[logo]" id="image_url" value="' . $logo . '" class="regular-text" />';
            $html .= '</fieldset></td></tr>';
            return $html;
        }

        public static function textOnBannerOnTop()
        {
            $text = WPEX_Theme_Options::get_theme_option('text_banner_on_top');
            $html = '';
            $html .= '<tr class="fold"><th scope="row">';
            $html .= '<div class="redux_field_th">Text On Banner Top<span class="description"> Change Text on Banner Top Homepage</span></div></th>';
            $html .= '<td>';
            $html .= '<fieldset id="theme_options-top_bar_right_social_icons" class="redux-field-container redux-field redux-container-sortable" data-id="top_bar_right_social_icons" data-type="sortable">';
            $html .='<input rel="top_bar_right_social_icons-facebook-hidden" class="regular-text " type="text" name="theme_options[text_banner_on_top]" id="top_bar_right_social_icons[facebook]" value="' .  $text . '" placeholder="Text">';
            $html .= '</fieldset></td></tr>';
            return $html;
        }

        public static function btnOnBannerOnTop()
        {
            $text = WPEX_Theme_Options::get_theme_option('text_btn_banner_on_top');
            $link = WPEX_Theme_Options::get_theme_option('link_btn_banner_on_top');
            $html = '';
            $html .= '<tr class="fold"><th scope="row">';
            $html .= '<div class="redux_field_th">Button On Banner Top<span class="description"> Change Button on Banner Top Homepage</span></div></th>';
            $html .= '<td>';
            $html .= '<fieldset id="theme_options-top_bar_right_social_icons" class="redux-field-container redux-field redux-container-sortable" data-id="top_bar_right_social_icons" data-type="sortable">';
            $html .= '<ul>';
            $html .='<li><label class="bugger" for="top_bar_right_social_icons[youtube]"><strong>Label Button</strong></label><br>';
            $html .='<input  class="regular-text " type="text" name="theme_options[text_btn_banner_on_top]"  value="' .  $text . '" placeholder="Text">';
            $html .= '</li>';
            $html .='<li><label class="bugger" for="top_bar_right_social_icons[youtube]"><strong>Link Button</strong></label><br>';
            $html .='<input class="regular-text " type="text" name="theme_options[link_btn_banner_on_top]" value="' .  $link . '" placeholder="Link">';
            $html .= '</li>';
            $html .= '</ul></fieldset></td></tr>';
            return $html;
        }

    }
}
new WPEX_Theme_Options();

// Helper function to use in your theme to return a theme option value
function myprefix_get_theme_option( $id = '' ) {
    return WPEX_Theme_Options::get_theme_option( $id );
}