<?php

/*
  ReduxFramework Smart Blog Config File
 */

if ( !class_exists( 'Redux_Framework_smart_blog_config' ) ) {

    class Redux_Framework_smart_blog_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( !class_exists( 'ReduxFramework' ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        /**
            Defines an array of options that will be used to generate the settings page.
        **/
        public function setSections() {

            // Background Patterns Reader
            $sample_patterns_path = get_template_directory() . '/images/patterns/';
            $sample_patterns_url  = get_template_directory_uri() . '/images/patterns/';
            $sample_patterns      = array();

            if ( is_dir( $sample_patterns_path ) ) :

                if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                    $sample_patterns = array();

                    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                        if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                            $name              = explode( '.', $sample_patterns_file );
                            $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            /**
                General
            **/
            $themepixels_admin_img_dir = get_template_directory_uri() . '/images/admin/';
            $this->sections[] = array(
                'title'     => __( 'General', 'themepixels' ),
                'heading'   => __( 'General', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-cog',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'site_layout',
                        'type'      => 'select',
                        'title'     => __('Site Layout', 'themepixels'),
                        'subtitle'  => __('Choose your layout style.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'fullwidth'     => __( 'Full Width','themepixels' ),
                            'boxed'         => __( 'Boxed','themepixels' )
                        ),
                        'default'   => 'fullwidth',
                        'select2'   => array( 'allowClear' => false ),
                    ),

                    array(
                        'id'        => 'global_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar Position', 'themepixels'),
                        'subtitle'  => __('Select default sidebar position.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $themepixels_admin_img_dir . 'right-sidebar.png'),
                            'left-sidebar'  => array('alt' => 'Left Sidebar', 'img' => $themepixels_admin_img_dir . 'left-sidebar.png'),
                            'both-sidebar'  => array('alt' => 'Both Sidebar', 'img' => $themepixels_admin_img_dir . 'both-sidebar.png'),
                            'no-sidebar'    => array('alt' => 'No Sidebar', 'img' => $themepixels_admin_img_dir . 'no-sidebar.png')
                        ),
                        'default'   => 'right-sidebar'
                    ),

                    array(
                        'id'        => 'scroll_top_button',
                        'type'      => 'switch',
                        'title'     => __('Scroll To Top Button', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable scroll to top button', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_preloader',
                        'type'      => 'switch',
                        'title'     => __('Preloader', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable preloader effect', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'    => 'favicon_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Favicon', 'themepixels' )
                    ),

                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Favicon', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your Favicon (16px x 16px).', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'iphone_icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Apple iPhone Icon', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your iPhone icon (57px x 57px).', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'ipad_icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Apple iPad Icon', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your iPad icon (72px x 72px).', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'iphone_icon_retina',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Apple iPhone Retina Icon', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your iPhone Retina icon (114px x 114px).', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'ipad_icon_retina',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Apple iPad Retina Icon', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your iPad Retina icon (144px x 144px).', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'    => 'tracking_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Tracking Code', 'themepixels' )
                    ),

                    array(
                        'id'        => 'tracking_code',
                        'type'      => 'textarea',
                        'title'     => __('Tracking Code', 'themepixels'),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __('Paste your Google Analytics or other tracking code here. This code will be added before the &lt;/body&gt; tag.', 'themepixels'),
                    ),

                ),
            );

            /**
                Typography
            **/
            $this->sections[] = array(
                'title'     => __( 'Typography', 'themepixels' ),
                'heading'   => __( 'Typography', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-font',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'                => 'body_font',
                        'type'              => 'typography',
                        'title'             => __( 'Body', 'themepixels' ),
                        //'compiler'        => true,
                        'google'            => true,
                        'font-backup'       => false,
                        'font-style'        => true,
                        'subsets'           => true,
                        'text-align'        => false,
                        'font-size'         => true,
                        'line-height'       => true,
                        'word-spacing'      => false,
                        'letter-spacing'    => false,
                        'color'             => false,
                        'preview'           => true,
                        'all_styles'        => true,
                        'output'            => array( 'body' ),
                        //'compiler'        => array( 'h2.site-description-compiler' ),
                        'units'             => 'px',
                        'subtitle'          => __( 'Specify the body font properties.', 'themepixels' ),
                        'default'           => array(
                            'font-style'    => '',
                            'font-family'   => 'Noto Serif',
                            'google'        => true,
                            'font-size'     => '',
                            'line-height'   => ''
                        ),
                    ),

                    array(
                        'id'                => 'heading_font',
                        'type'              => 'typography',
                        'title'             => __( 'Heading', 'themepixels' ),
                        //'compiler'        => true,
                        'google'            => true,
                        'font-backup'       => false,
                        'font-style'        => true,
                        'subsets'           => false,
                        'text-align'        => false,
                        'font-size'         => false,
                        'line-height'       => false,
                        'word-spacing'      => false,
                        'letter-spacing'    => false,
                        'color'             => false,
                        'preview'           => true,
                        'all_styles'        => true,
                        'output'            => array( 'h1, h2, h3, h4, h5, h6' ),
                        //'compiler'        => array( 'h2.site-description-compiler' ),
                        'units'             => 'px',
                        'subtitle'          => __( 'Specify the heading font properties.', 'themepixels' ),
                        'default'           => array(
                            'font-style'    => '',
                            'font-family'   => '',
                            'google'        => true
                        ),
                    ),

                    array(
                        'id'    => 'top_menu_typography_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Top Menu', 'themepixels' )
                    ),

                    array(
                        'id'                => 'top_menu_font',
                        'type'              => 'typography',
                        'title'             => __( 'Top Menu', 'themepixels' ),
                        //'compiler'        => true,
                        'google'            => true,
                        'font-backup'       => false,
                        'font-style'        => false,
                        'font-weight'       => false,
                        'subsets'           => false,
                        'text-align'        => false,
                        'font-size'         => false,
                        'line-height'       => false,
                        'word-spacing'      => false,
                        'letter-spacing'    => false,
                        'color'             => false,
                        'preview'           => true,
                        'all_styles'        => true,
                        'output'            => array( '.top-navigation' ),
                        //'compiler'        => array( 'h2.site-description-compiler' ),
                        'units'             => 'px',
                        'subtitle'          => __( 'Specify the top menu font.', 'themepixels' ),
                        'default'           => array(
                            'font-family'   => '',
                            'google'        => true
                        ),
                    ),

                    array(
                        'id'        => 'top_menu_font_size',
                        'type'      => 'text',
                        'title'     => __('Top Menu Font Size', 'themepixels'),
                        'subtitle'  => __('Specify the top menu font size', 'themepixels'),
                        'desc'      => __('Value is in px.', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'    => 'primary_menu_typography_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Primary Menu', 'themepixels' )
                    ),

                    array(
                        'id'                => 'primary_menu_font',
                        'type'              => 'typography',
                        'title'             => __( 'Primary Menu', 'themepixels' ),
                        //'compiler'        => true,
                        'google'            => true,
                        'font-backup'       => false,
                        'font-style'        => false,
                        'font-weight'       => false,
                        'subsets'           => false,
                        'text-align'        => false,
                        'font-size'         => false,
                        'line-height'       => false,
                        'word-spacing'      => false,
                        'letter-spacing'    => false,
                        'color'             => false,
                        'preview'           => true,
                        'all_styles'        => true,
                        'output'            => array( '.primary-navigation' ),
                        //'compiler'        => array( 'h2.site-description-compiler' ),
                        'units'             => 'px',
                        'subtitle'          => __( 'Specify the primary menu font.', 'themepixels' ),
                        'default'           => array(
                            'font-family'   => '',
                            'google'        => true
                        ),
                    ),

                    array(
                        'id'        => 'primary_menu_font_size',
                        'type'      => 'text',
                        'title'     => __('Primary Menu Font Size', 'themepixels'),
                        'subtitle'  => __('Specify the primary menu font size', 'themepixels'),
                        'desc'      => __('Value is in px.', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'    => 'dropdown_menu_typography_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Dropdown Menu', 'themepixels' )
                    ),

                    array(
                        'id'        => 'dropdown_menu_font_size',
                        'type'      => 'text',
                        'title'     => __('Dropdown Menu Font Size', 'themepixels'),
                        'subtitle'  => __('Specify the dropdown menu font size', 'themepixels'),
                        'desc'      => __('Value is in px.', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'    => 'dropdown_menu_typography_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Dropdown Megamenu', 'themepixels' )
                    ),

                    array(
                        'id'        => 'dropdown_megamenu_col_title_font_size',
                        'type'      => 'text',
                        'title'     => __('Dropdown Megamenu Column Title Font Size', 'themepixels'),
                        'subtitle'  => __('Specify the dropdown megamenu column title font size', 'themepixels'),
                        'desc'      => __('Value is in px.', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'dropdown_megamenu_font_size',
                        'type'      => 'text',
                        'title'     => __('Dropdown Megamenu Font Size', 'themepixels'),
                        'subtitle'  => __('Specify the dropdown megamenu font size', 'themepixels'),
                        'desc'      => __('Value is in px.', 'themepixels'),
                        'default'   => '',
                    ),

                ),
            );

            /**
                Styling
            **/
            $this->sections[] = array(
                'title'     => __( 'Styling', 'themepixels' ),
                'heading'   => __( 'Styling - General', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-brush',
                'submenu'   => true,
                'fields'    => array(),
            );

            // Styling - General
            $this->sections[] = array(
                'title'         => __( 'General', 'themepixels' ),
                'heading'       => __( 'General', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'theme_primary_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Primary Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'body_bg_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Body', 'themepixels' )
                    ),

                    array(
                        'id'            => 'body_background_type',
                        'type'          => 'radio',
                        'title'         => __( 'Background Type', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        'options'       => array(
                            'pattern'   => 'Pattern',
                            'custom'    => 'Custom Background'
                        ),
                        'default'       => 'pattern'
                    ),

                    array(
                        'id'            => 'body_pattern_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'required'      => array('body_background_type', 'equals', 'pattern'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'        => 'body_background_pattern',
                        'type'      => 'image_select',
                        'tiles'     => true,
                        'title'     => __('Background Pattern', 'themepixels'),
                        'subtitle'  => __('', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('body_background_type', 'equals', 'pattern'),
                        'options'   => $sample_patterns,
                        'default'   => ''
                    ),

                    array(
                        'id'            => 'body_custom_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Body Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'required'      => array('body_background_type', 'equals', 'custom'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'body_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Body Text Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'body_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'    => 'heading_color_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Heading', 'themepixels' )
                    ),

                    array(
                        'id'            => 'h1_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H1 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'h2_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H2 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'h3_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H3 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'h4_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H4 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'h5_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H5 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'h6_heading_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('H6 Heading Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                ),
            );

            // Styling - Topbar
            $this->sections[] = array(
                'title'         => __( 'Top Bar', 'themepixels' ),
                'heading'       => __( 'Top Bar', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'top_bar_background',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Top Bar Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_bar_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Top Bar Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_bar_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Top Bar Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'    => 'top_bar_search_color_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Top Bar Search', 'themepixels' )
                    ),

                    array(
                        'id'            => 'top_bar_search_background',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Search Icon Background', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_bar_search_background_hover',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Search Icon Background Hover', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_bar_search_icon_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Search Icon Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'    => 'top_bar_social_icon_color_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Top Bar Social Icons', 'themepixels' )
                    ),

                    array(
                        'id'            => 'top_bar_social_icon_background',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Social Icons Background', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_bar_social_icon_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Social Icons Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                ),
            );

            // Styling - Header
            $this->sections[] = array(
                'title'         => __( 'Header', 'themepixels' ),
                'heading'       => __( 'Header', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'header_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Header Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'header_search_icon_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Header Search Icon Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                ),
            );

            // Styling - Sticky Header
            $this->sections[] = array(
                'title'         => __( 'Sticky Header', 'themepixels' ),
                'heading'       => __( 'Sticky Header', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'sticky_header_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Sticky Header Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'sticky_header_search_icon_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Sticky Header Search Icon Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                ),
            );

            // Styling - Navigation
            $this->sections[] = array(
                'title'         => __( 'Navigation', 'themepixels' ),
                'heading'       => __( 'Navigation', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'    => 'top_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Top Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'top_menu_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Menu Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'top_menu_current_link_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Current Menu Link Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'primary_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Primary Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'primary_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'primary_menu_link_hover_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Menu Link Hover Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'primary_menu_current_link_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Current Menu Link Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'primary_menu_current_link_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Current Menu Link Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'sticky_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Sticky Header Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'sticky_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'sticky_menu_link_hover_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Menu Link Hover Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'sticky_menu_current_link_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Current Menu Link Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'sticky_menu_current_link_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Current Menu Link Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'dropdown_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Dropdown Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'dropdown_menu_top_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Dropdown Menu Top Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'dropdown_menu_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Dropdown Menu Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'dropdown_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Dropdown Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'dropdown_menu_link_hover_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Dropdown Menu Link Hover Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'dropdown_menu_link_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Dropdown Menu Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'megamenu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Dropdown Megamenu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'megamenu_top_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Megamenu Top Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'megamenu_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Megamenu Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'megamenu_column_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Megamenu Column Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'megamenu_column_title_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Megamenu Column Title Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'megamenu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Megamenu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'megamenu_link_hover_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Megamenu Link Hover Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'responsive_top_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Top Mobile Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'top_mobile_menu_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Top Mobile Menu Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_mobile_menu_link_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Top Mobile Menu Link Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'top_mobile_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Top Mobile Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'    => 'responsive_primary_menu_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Primary Mobile Menu', 'themepixels' )
                    ),

                    array(
                        'id'            => 'primary_mobile_menu_background_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Primary Mobile Menu Background Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'primary_mobile_menu_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Primary Mobile Menu Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'primary_mobile_menu_link_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Primary Mobile Menu Link Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                ),
            );

            // Styling - Content Area
            $this->sections[] = array(
                'title'         => __( 'Content Area', 'themepixels' ),
                'heading'       => __( 'Content Area', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'content_area_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Content Area Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'    => 'post_box_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Post Box', 'themepixels' )
                    ),

                    array(
                        'id'            => 'post_box_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Post Box Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'post_box_outer_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Post Box Outer Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'post_box_title_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Post Title Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'post_box_meta_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Post Meta Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'    => 'post_box_social_icon_color_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Post Box Footer Social Icons', 'themepixels' )
                    ),

                    array(
                        'id'            => 'post_box_social_icon_background',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Social Icons Background', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'post_box_social_icon_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Social Icons Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'post_navigation_button_color_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Numbered Pagination', 'themepixels' )
                    ),

                    array(
                        'id'            => 'post_numbered_pagination_background_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Numbered Pagination Background Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        //'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                            'active'    => '',
                        )
                    ),

                    array(
                        'id'            => 'post_numbered_pagination_text_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Numbered Pagination Text Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        //'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                            'active'    => '',
                        )
                    ),

                ),
            );

            // Styling - Sidebar
            $this->sections[] = array(
                'title'         => __( 'Sidebar', 'themepixels' ),
                'heading'       => __( 'Sidebar', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'sidebar_widgets_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Sidebar Widgets Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'sidebar_widgets_outer_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Sidebar Widgets Outer Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'sidebar_widgets_title_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Sidebar Widgets Title Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'sidebar_widgets_title_border_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Sidebar Widgets Title Border Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'sidebar_widgets_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Sidebar Widgets Text Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'sidebar_widgets_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Sidebar Widgets Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'sidebar_widgets_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Sidebar Widgets Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                ),
            );

            // Styling - Footer
            $this->sections[] = array(
                'title'         => __( 'Footer', 'themepixels' ),
                'heading'       => __( 'Footer', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'footer_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Footer Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'footer_widget_title_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Footer Widget Title Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'footer_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Footer Text Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'footer_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Footer Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                    array(
                        'id'            => 'footer_border_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Footer Border Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'    => 'footer_bottom_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Footer Bottom', 'themepixels' )
                    ),

                    array(
                        'id'            => 'footer_bottom_background',
                        'type'          => 'background',
                        //'output'      => array( 'body' ),
                        'title'         => __( 'Footer Bottom Background', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'transparent'   => false,
                        'preview'       => false,
                        'default'       => '',
                    ),

                    array(
                        'id'            => 'footer_bottom_text_color',
                        'type'          => 'color',
                        //'output'      => array('.site-title'),
                        'title'         => __('Footer Bottom Text Color', 'themepixels'),
                        'subtitle'      => __('', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'default'       => '',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'footer_bottom_link_color',
                        'type'          => 'link_color',
                        'title'         => __( 'Footer Bottom Link Color', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __( '', 'themepixels' ),
                        //'regular'     => false,
                        //'hover'       => false,
                        'active'        => false,
                        'visited'       => false,
                        'default'       => array(
                            'regular'   => '',
                            'hover'     => '',
                        )
                    ),

                ),
            );

            // Styling - Custom CSS
            $this->sections[] = array(
                'title'         => __( 'Custom CSS', 'themepixels' ),
                'heading'       => __( 'Custom CSS', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                //'icon'          => 'el-icon-credit-card',
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'global_custom_css',
                        'type'          => 'ace_editor',
                        'title'         => __( 'Custom CSS', 'themepixels' ),
                        'subtitle'      => __( '', 'themepixels' ),
                        'desc'          => __('', 'themepixels'),
                        'mode'          => 'css',
                        'theme'         => 'monokai',
                        'default'       => '',
                    ),

                ),
            );

            /**
                Top Bar
            **/
            $this->sections[] = array(
                'title'     => __( 'Top Bar', 'themepixels' ),
                'heading'   => __( 'Top Bar', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-credit-card',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'top_bar',
                        'type'      => 'switch',
                        'title'     => __('Top Bar', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable header top bar', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'top_bar_search',
                        'type'      => 'switch',
                        'title'     => __('Top Bar Search', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable top bar search', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'top_bar_social_link_target',
                        'type'      => 'switch',
                        'title'     => __('Open social links in new window', 'themepixels'),
                        'subtitle'  => __('Open topbar social links in new window', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'top_bar_left',
                        'type'      => 'select',
                        'title'     => __('Top Bar Left', 'themepixels'),
                        'subtitle'  => __('Choose what to display in top bar left area', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'navigation'        => __( 'Navigation','themepixels' ),
                            'social-icons'      => __( 'Social Icons','themepixels' ),
                            'custom-content'    => __( 'Custom Content','themepixels' )
                        ),
                        'default'   => 'navigation',
                    ),

                    array(
                        'id'        => 'top_left_custom',
                        'type'      => 'editor',
                        'title'     => __('Custom Content', 'themepixels'),
                        'subtitle'  => __('Enter your custom content for your top bar. Shortcodes are Allowed.', 'themepixels'),
                        'default'   => '[top_bar_info][top_bar_info_item icon="phone"]1-800-987-654[/top_bar_info_item][top_bar_info_item icon="cog"]1-800-987-654[/top_bar_info_item][/top_bar_info]',
                        'required'  => array('top_bar_left', 'equals', 'custom-content'),
                        'args'      => array(
                            'teeny' => false
                        ),
                    ),

                    array(
                        'id'        => 'top_bar_left_social_icons',
                        'type'      => 'sortable',
                        'title'     => __('Social Icons', 'themepixels'),
                        'subtitle'  => __('Enter the full URL to your social profile', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'label'     => true,
                        'required'  => array('top_bar_left', 'equals', 'social-icons'),
                        'options'   => array(
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'google-plus'   => __( 'Google Plus','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'dribbble'      => __( 'Dribbble','themepixels' ),
                            'skype'         => __( 'Skype','themepixels' ),
                            'github'        => __( 'Github','themepixels' ),
                            'foursquare'    => __( 'Foursquare','themepixels' ),
                            'flickr'        => __( 'Flickr','themepixels' ),
                            'instagram'     => __( 'Instagram','themepixels' ),
                            'tumblr'        => __( 'Tumblr','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'youtube'       => __( 'Youtube','themepixels' ),
                            'vimeo'         => __( 'Vimeo','themepixels' ),
                            'vk'            => __( 'VK','themepixels' ),
                            'rss'           => __( 'RSS','themepixels' ),
                        ),
                        'default'   => array(
                            'twitter'       => '#',
                            'facebook'      => '#',
                            'google-plus'   => '#',
                            'linkedin'      => '#',
                            'dribbble'      => '#',
                            'skype'         => '',
                            'github'        => '',
                            'foursquare'    => '',
                            'flickr'        => '',
                            'instagram'     => '',
                            'tumblr'        => '',
                            'pinterest'     => '',
                            'youtube'       => '',
                            'vimeo'         => '',
                            'vk'            => '',
                            'rss'           => '',
                        )
                    ),

                    array(
                        'id'        => 'top_bar_right',
                        'type'      => 'select',
                        'title'     => __('Top Bar Right', 'themepixels'),
                        'subtitle'  => __('Choose what to display in top bar right area', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'navigation'        => __( 'Navigation','themepixels' ),
                            'social-icons'      => __( 'Social Icons','themepixels' ),
                            'custom-content'    => __( 'Custom Content','themepixels' )
                        ),
                        'default'   => 'social-icons',
                    ),

                    array(
                        'id'        => 'top_right_custom',
                        'type'      => 'editor',
                        'title'     => __('Custom Content', 'themepixels'),
                        'subtitle'  => __('Enter your custom content for your top bar. Shortcodes are Allowed.', 'themepixels'),
                        'default'   => '[top_bar_info][top_bar_info_item icon="phone"]1-800-987-654[/top_bar_info_item][top_bar_info_item icon="cog"]1-800-987-654[/top_bar_info_item][/top_bar_info]',
                        'required'  => array('top_bar_right', 'equals', 'custom-content'),
                        'args'      => array(
                            'teeny' => false
                        ),
                    ),

                    array(
                        'id'        => 'top_bar_right_social_icons',
                        'type'      => 'sortable',
                        'title'     => __('Social Icons', 'themepixels'),
                        'subtitle'  => __('Enter the full URL to your social profile', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'label'     => true,
                        'required'  => array('top_bar_right', 'equals', 'social-icons'),
                        'options'   => array(
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'google-plus'   => __( 'Google Plus','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'dribbble'      => __( 'Dribbble','themepixels' ),
                            'skype'         => __( 'Skype','themepixels' ),
                            'github'        => __( 'Github','themepixels' ),
                            'foursquare'    => __( 'Foursquare','themepixels' ),
                            'flickr'        => __( 'Flickr','themepixels' ),
                            'instagram'     => __( 'Instagram','themepixels' ),
                            'tumblr'        => __( 'Tumblr','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'youtube'       => __( 'Youtube','themepixels' ),
                            'vimeo'         => __( 'Vimeo','themepixels' ),
                            'vk'            => __( 'VK','themepixels' ),
                            'rss'           => __( 'RSS','themepixels' ),
                        ),
                        'default'   => array(
                            'twitter'       => '#',
                            'facebook'      => '#',
                            'google-plus'   => '#',
                            'linkedin'      => '#',
                            'dribbble'      => '#',
                            'skype'         => '',
                            'github'        => '',
                            'foursquare'    => '',
                            'flickr'        => '',
                            'instagram'     => '',
                            'tumblr'        => '',
                            'pinterest'     => '',
                            'youtube'       => '',
                            'vimeo'         => '',
                            'vk'            => '',
                            'rss'           => '',
                        )
                    ),

                ),
            );

            /**
                Header
            **/
            $this->sections[] = array(
                'title'     => __( 'Header', 'themepixels' ),
                'heading'   => __( 'Header', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-website',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'header_layout',
                        'type'      => 'image_select',
                        'title'     => __('Select Header Layout', 'themepixels'),
                        'subtitle'  => __('Choose your header layout', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'v1'    => array('alt' => 'Header One', 'img' => $themepixels_admin_img_dir . 'header-v1.png'),
                            'v2'    => array('alt' => 'Header Two', 'img' => $themepixels_admin_img_dir . 'header-v2.png'),
                            'v3'    => array('alt' => 'Header Three', 'img' => $themepixels_admin_img_dir . 'header-v3.png')
                        ),
                        'default'   => 'v1'
                    ),

                    array(
                        'id'            => 'header_v2_height',
                        'type'          => 'slider',
                        'title'         => __('Header Height', 'themepixels'),
                        'subtitle'      => __('Specify height for your header', 'themepixels'),
                        'desc'          => __('Value is in px.', 'themepixels'),
                        'required'      => array('header_layout', 'equals', 'v2'),
                        'default'       => 100,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 300,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'header_ad_space_content',
                        'type'      => 'editor',
                        'title'     => __('Header Ad Space Content', 'themepixels'),
                        'subtitle'  => __('Enter your ad content for your header.', 'themepixels'),
                        'default'   => __('', 'themepixels'),
                        'required'  => array('header_layout', 'equals', 'v3'),
                        'args'      => array(
                            'teeny' => false
                        ),
                    ),

                    array(
                        'id'        => 'header_ad_space_top_margin',
                        'type'      => 'text',
                        'title'     => __('Header Ad Space Top Margin', 'themepixels'),
                        'subtitle'  => __('Specify top margin for your header ad space.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('header_layout', 'equals', 'v3'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'header_ad_space_bottom_margin',
                        'type'      => 'text',
                        'title'     => __('Header Ad Space Bottom Margin', 'themepixels'),
                        'subtitle'  => __('Specify bottom margin for your header ad space.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('header_layout', 'equals', 'v3'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'header_search',
                        'type'      => 'switch',
                        'title'     => __('Header Search', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable header search.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'    => 'logo_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Logo Options', 'themepixels' )
                    ),

                    array(
                        'id'        => 'logo_image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Logo', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your custom logo.', 'themepixels' ),
                        'default'   => array(
                            'url'   => get_template_directory_uri() .'/images/logo.png'
                        ),
                    ),

                    array(
                        'id'        => 'retina_logo_image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __( 'Retina Logo', 'themepixels' ),
                        'desc'      => __( '', 'themepixels' ),
                        'subtitle'  => __( 'Upload your retina logo. This should be your logo in double size.', 'themepixels' ),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'retina_logo_width',
                        'type'      => 'text',
                        'title'     => __('Standard Logo Width', 'themepixels'),
                        'subtitle'  => __('If Retina Logo uploaded, please enter the width of the Standard Logo (not the Retina Logo)', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'retina_logo_height',
                        'type'      => 'text',
                        'title'     => __('Standard Logo Height', 'themepixels'),
                        'subtitle'  => __('If Retina Logo uploaded, please enter the height of the Standard Logo (not the Retina Logo)', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'logo_top_margin',
                        'type'      => 'text',
                        'title'     => __('Logo Top Margin', 'themepixels'),
                        'subtitle'  => __('Specify top margin for your header logo.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'logo_bottom_margin',
                        'type'      => 'text',
                        'title'     => __('Logo Bottom Margin', 'themepixels'),
                        'subtitle'  => __('Specify bottom margin for your header logo.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                ),
            );

            /**
                Sticky Header
            **/
            $this->sections[] = array(
                'title'     => __( 'Sticky Header', 'themepixels' ),
                'heading'   => __( 'Sticky Header', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-credit-card',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => __('Sticky Header', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable sticky header.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'sticky_logo_top_margin',
                        'type'      => 'text',
                        'title'     => __('Sticky Header - Logo Top Margin', 'themepixels'),
                        'subtitle'  => __('Specify top margin for your sticky header logo.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'sticky_logo_bottom_margin',
                        'type'      => 'text',
                        'title'     => __('Sticky Header - Logo Bottom Margin', 'themepixels'),
                        'subtitle'  => __('Specify bottom margin for your sticky header logo.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'default'   => '',
                    ),

                    array(
                        'id'            => 'sticky_header_height',
                        'type'          => 'slider',
                        'title'         => __('Sticky Header Height', 'themepixels'),
                        'subtitle'      => __('Specify height for your sticky header.', 'themepixels'),
                        'desc'          => __('Value is in px.', 'themepixels'),
                        'default'       => 80,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 250,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'sticky_search',
                        'type'      => 'switch',
                        'title'     => __('Sticky Header Search', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable sticky search.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Footer
            **/
            $this->sections[] = array(
                'title'     => __( 'Footer', 'themepixels' ),
                'heading'   => __( 'Footer', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-website-alt',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'footer_widgets',
                        'type'      => 'switch',
                        'title'     => __('Footer Widgets', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable footer widgets.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'footer_col',
                        'type'      => 'image_select',
                        'title'     => __('Footer Columns', 'themepixels'),
                        'subtitle'  => __('Choose number of columns in footer.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('footer_widgets', 'equals', '1'),
                        'options'   => array(
                            '1'  => array('alt' => '1 Column', 'img' => $themepixels_admin_img_dir . 'footer-1col.png'),
                            '2'  => array('alt' => '2 Columns', 'img' => $themepixels_admin_img_dir . 'footer-2col.png'),
                            '3'  => array('alt' => '3 Columns', 'img' => $themepixels_admin_img_dir . 'footer-3col.png'),
                            '4'  => array('alt' => '4 Columns', 'img' => $themepixels_admin_img_dir . 'footer-4col.png'),
                            '5'  => array('alt' => '5 Columns', 'img' => $themepixels_admin_img_dir . 'footer-5col.png')
                        ),
                        'default'   => '4'
                    ),

                    array(
                        'id'        => 'footer_bottom',
                        'type'      => 'switch',
                        'title'     => __('Footer Bottom', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable footer bottom.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'footer_copyright',
                        'type'      => 'editor',
                        'title'     => __('Copyrights', 'themepixels'),
                        'subtitle'  => __('Enter your custom copyright content.', 'themepixels'),
                        'required'  => array('footer_bottom', 'equals', '1'),
                        'default'   => __('2015 SmartBlog | Designed by <a href="#">ThemePixels</a>', 'themepixels'),
                        'args'      => array(
                            'teeny' => false
                        ),
                    ),

                    array(
                        'id'        => 'footer_bottom_widgets',
                        'type'      => 'select',
                        'title'     => __('Footer Bottom Widgets', 'themepixels'),
                        'subtitle'  => __('Choose what to display in footer bottom area.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('footer_bottom', 'equals', '1'),
                        'options'   => array(
                            'navigation'        => __( 'Navigation','themepixels' ),
                            'social-icons'      => __( 'Social Icons','themepixels' )
                        ),
                        'default'   => 'social-icons',
                    ),

                    array(
                        'id'        => 'footer_social_link_target',
                        'type'      => 'switch',
                        'title'     => __('Open social links in new window', 'themepixels'),
                        'subtitle'  => __('Open footer social links in new window', 'themepixels'),
                        'required'  => array('footer_bottom_widgets', 'equals', 'social-icons'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'footer_bottom_social_icons',
                        'type'      => 'sortable',
                        'title'     => __('Social Icons', 'themepixels'),
                        'subtitle'  => __('Enter the full URL to your social profile.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'label'     => true,
                        'required'  => array('footer_bottom_widgets', 'equals', 'social-icons'),
                        'options'   => array(
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'google-plus'   => __( 'Google Plus','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'dribbble'      => __( 'Dribbble','themepixels' ),
                            'skype'         => __( 'Skype','themepixels' ),
                            'github'        => __( 'Github','themepixels' ),
                            'foursquare'    => __( 'Foursquare','themepixels' ),
                            'flickr'        => __( 'Flickr','themepixels' ),
                            'instagram'     => __( 'Instagram','themepixels' ),
                            'tumblr'        => __( 'Tumblr','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'youtube'       => __( 'Youtube','themepixels' ),
                            'vimeo'         => __( 'Vimeo','themepixels' ),
                            'vk'            => __( 'VK','themepixels' ),
                            'rss'           => __( 'RSS','themepixels' ),
                        ),
                        'default'   => array(
                            'twitter'       => '#',
                            'facebook'      => '#',
                            'google-plus'   => '#',
                            'linkedin'      => '#',
                            'dribbble'      => '#',
                            'skype'         => '',
                            'github'        => '',
                            'foursquare'    => '',
                            'flickr'        => '',
                            'instagram'     => '',
                            'tumblr'        => '',
                            'pinterest'     => '',
                            'youtube'       => '',
                            'vimeo'         => '',
                            'vk'            => '',
                            'rss'           => '',
                        )
                    ),

                ),
            );

            /**
                Slider
            **/
            $this->sections[] = array(
                'title'         => __( 'Slider', 'themepixels' ),
                'heading'       => __( 'Slider', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                'icon'          => 'el-icon-adjust-alt',
                'submenu'       => true,
                'fields'        => array(

                    array(
                        'id'        => 'enable_homepage_slideshow',
                        'type'      => 'switch',
                        'title'     => __('Homepage Featured Slider', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable homepage slideshow.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'slideshow_style',
                        'type'      => 'image_select',
                        'title'     => __('Slideshow Style', 'themepixels'),
                        'subtitle'  => __('Choose your slideshow layout.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'v1'  => array('alt' => 'Slider Style 1', 'img' => $themepixels_admin_img_dir . 'slider-1.png'),
                            'v2' => array('alt' => 'Slider Style 2', 'img' => $themepixels_admin_img_dir . 'slider-2.png')
                        ),
                        'default'   => 'v1'
                    ),

                    array(
                        'id'            => 'slideshow_posts_cats',
                        'type'          => 'select',
                        'title'         => __('Featured Slider Categories', 'themepixels'),
                        'subtitle'      => __('Select categories for slideshow.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1')
                        'multi'         => true,
                        'data'          => 'categories'
                    ),

                    array(
                        'id'            => 'slideshow_posts_count',
                        'type'          => 'slider',
                        'title'         => __('Number of posts', 'themepixels'),
                        'subtitle'      => __('Choose the number of posts you want to show in slideshow.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 6,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 30,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'enable_slideshow_nav',
                        'type'      => 'switch',
                        'title'     => __('Next / Previous Navigation', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable next/prev navigation for slideshow.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_slideshow_dots_nav',
                        'type'      => 'switch',
                        'title'     => __('Dots Navigation', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable dots navigation for slideshow.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_slideshow_infinity_loop',
                        'type'      => 'switch',
                        'title'     => __('Infinity Loop', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable infinity loop for slideshow.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_slideshow_autoplay',
                        'type'      => 'switch',
                        'title'     => __('Autoplay', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable autoplay for slideshow.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'            => 'slideshow_duration',
                        'type'          => 'slider',
                        'title'         => __('Slideshow Duration', 'themepixels'),
                        'subtitle'      => __('Controls the duration of slideshow.', 'themepixels'),
                        'desc'          => __('Value is in ms.', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 5000,
                        'min'           => 1000,
                        'step'          => 500,
                        'max'           => 10000,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'enable_slideshow_pause_on_hover',
                        'type'      => 'switch',
                        'title'     => __('Pause On Hover', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable pause on hover for slideshow.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Carousel
            **/
            $this->sections[] = array(
                'title'         => __( 'Featured Carousel', 'themepixels' ),
                'heading'       => __( 'Featured Carousel', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                'icon'          => 'el-icon-adjust-alt',
                'submenu'       => true,
                'fields'        => array(

                    array(
                        'id'        => 'enable_homepage_carousel',
                        'type'      => 'switch',
                        'title'     => __('Homepage Featured Carousel', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable homepage carousel.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'carousel_position',
                        'type'      => 'select',
                        'title'     => __('Carousel Position', 'themepixels'),
                        'subtitle'  => __('Select carousel position.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'below-header'      => __( 'Below Header','themepixels' ),
                            'above-footer'      => __( 'Above Footer','themepixels' )
                        ),
                        'default'   => 'below-header',
                        'select2'   => array( 'allowClear' => false ),
                    ),

                    array(
                        'id'            => 'carousel_posts_cats',
                        'type'          => 'select',
                        'title'         => __('Featured Carousel Categories', 'themepixels'),
                        'subtitle'      => __('Select categories for carousel.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'multi'         => true,
                        'data'          => 'categories'
                    ),

                    array(
                        'id'            => 'carousel_posts_count',
                        'type'          => 'slider',
                        'title'         => __('Number of posts', 'themepixels'),
                        'subtitle'      => __('Choose the number of posts you want to show in carousel.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 6,
                        'min'           => 2,
                        'step'          => 1,
                        'max'           => 30,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'            => 'carousel_item_lg_desktop',
                        'type'          => 'slider',
                        'title'         => __('Items visible on desktop', 'themepixels'),
                        'subtitle'      => __('The number of items to show on the large Desktop (Above 1199px).', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 4,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 15,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'            => 'carousel_item_small_desktop',
                        'type'          => 'slider',
                        'title'         => __('Items visible on small desktop', 'themepixels'),
                        'subtitle'      => __('The number of items to show on the large Desktop (Above 991px).', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 3,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 15,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'            => 'carousel_item_tablet',
                        'type'          => 'slider',
                        'title'         => __('Items visible on tablet', 'themepixels'),
                        'subtitle'      => __('The number of items to show on the tablet (Above 767px).', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 2,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 15,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'            => 'carousel_item_small_tablet',
                        'type'          => 'slider',
                        'title'         => __('Items visible on small tablet', 'themepixels'),
                        'subtitle'      => __('The number of items to show on the small tablet (Above 479px).', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 2,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 15,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'            => 'carousel_item_mobile',
                        'type'          => 'slider',
                        'title'         => __('Items visible on mobile', 'themepixels'),
                        'subtitle'      => __('The number of items to show on the mobile (0 to 479px).', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 1,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 15,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'enable_carousel_nav',
                        'type'      => 'switch',
                        'title'     => __('Next / Previous Navigation', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable next/prev navigation for carousel.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_carousel_infinity_loop',
                        'type'      => 'switch',
                        'title'     => __('Infinity Loop', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable infinity loop for carousel.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_carousel_autoplay',
                        'type'      => 'switch',
                        'title'     => __('Autoplay', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable autoplay for carousel.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'            => 'carousel_duration',
                        'type'          => 'slider',
                        'title'         => __('Carousel Duration', 'themepixels'),
                        'subtitle'      => __('Controls the duration of carousel.', 'themepixels'),
                        'desc'          => __('Value is in ms.', 'themepixels'),
                        //'required'      => array('enable_slideshow_autoplay', 'equals', '1'),
                        'default'       => 5000,
                        'min'           => 1000,
                        'step'          => 500,
                        'max'           => 10000,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'enable_carousel_pause_on_hover',
                        'type'      => 'switch',
                        'title'     => __('Pause On Hover', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable pause on hover for carousel.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Blog
            **/
            $this->sections[] = array(
                'title'         => __( 'Blog Options', 'themepixels' ),
                'heading'       => __( 'General Blog Options', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                'icon'          => 'el-icon-edit',
                'submenu'       => true,
                'fields'        => array(

                    array(
                        'id'        => 'blog_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar Position', 'themepixels'),
                        'subtitle'  => __('Select sidebar position for blog.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'default'  => array('alt' => 'Default', 'img' => $themepixels_admin_img_dir . 'default-sidebar.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $themepixels_admin_img_dir . 'right-sidebar.png'),
                            'left-sidebar'  => array('alt' => 'Left Sidebar', 'img' => $themepixels_admin_img_dir . 'left-sidebar.png'),
                            'both-sidebar'  => array('alt' => 'Both Sidebar', 'img' => $themepixels_admin_img_dir . 'both-sidebar.png'),
                            'no-sidebar'    => array('alt' => 'No Sidebar', 'img' => $themepixels_admin_img_dir . 'no-sidebar.png')
                        ),
                        'default'   => 'default'
                    ),

                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'image_select',
                        'title'     => __('Blog Layout', 'themepixels'),
                        'subtitle'  => __('Select the layout for the assigned blog page in settings > reading.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'style-1'   => array('alt' => 'Blog 1 Column', 'img' => $themepixels_admin_img_dir . '1col.png'),
                            'style-2'   => array('alt' => 'Masonry 2 Columns', 'img' => $themepixels_admin_img_dir . '2col.png'),
                            'style-3'   => array('alt' => 'Masonry 3 Columns', 'img' => $themepixels_admin_img_dir . '3col.png')
                        ),
                        'default'   => 'style-1'
                    ),

                    array(
                        'id'        => 'archive_layout',
                        'type'      => 'image_select',
                        'title'     => __('Archive Layout', 'themepixels'),
                        'subtitle'  => __('Select the layout for the blog archive/category pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'style-1'   => array('alt' => 'Blog 1 Column', 'img' => $themepixels_admin_img_dir . '1col.png'),
                            'style-2'   => array('alt' => 'Masonry 2 Columns', 'img' => $themepixels_admin_img_dir . '2col.png'),
                            'style-3'   => array('alt' => 'Masonry 3 Columns', 'img' => $themepixels_admin_img_dir . '3col.png')
                        ),
                        'default'   => 'style-1'
                    ),

                    array(
                        'id'        => 'blog_pagination_type',
                        'type'      => 'select',
                        'title'     => __('Pagination Type', 'themepixels'),
                        'subtitle'  => __('Choose your pagination type.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'numbered-pagination'       => __( 'Numbered Pagination','themepixels' ),
                            'next-prev'                 => __( 'Next/Prev','themepixels' )
                        ),
                        'default'   => 'numbered-pagination',
                        'select2'   => array( 'allowClear' => false ),
                    ),

                    array(
                        'id'        => 'enable_post_header',
                        'type'      => 'switch',
                        'title'     => __('Post Header', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post header for blog.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_meta',
                        'type'      => 'switch',
                        'title'     => __('Post Meta', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post meta for blog.', 'themepixels'),
                        'required'  => array('enable_post_header', 'equals', '1'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'post_meta_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Post Meta Links', 'themepixels'),
                        'subtitle'  => __('Check which meta links to show for blog.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('enable_post_meta', 'equals', '1'),
                        'options'   => array(
                            'author'    => __( 'Author','themepixels' ),
                            'date'      => __( 'Date','themepixels' ),
                            'views'     => __( 'Views','themepixels' ),
                            'likes'     => __( 'Likes','themepixels' ),
                            'comments'  => __( 'Comments','themepixels' ),
                        ),
                        'default'   => array(
                            'author'    => true,
                            'date'      => true,
                            'views'     => true,
                            'likes'     => true,
                            'comments'  => true,
                        )
                    ),

                    array(
                        'id'        => 'enable_post_featured_content',
                        'type'      => 'switch',
                        'title'     => __('Post Featured Content', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post featured content for blog.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'blog_excerpt',
                        'type'      => 'switch',
                        'title'     => __('Blog Excerpt', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable auto excerpt for blog.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'            => 'blog_excerpt_length',
                        'type'          => 'slider',
                        'title'         => __('Blog Excerpt Length', 'themepixels'),
                        'subtitle'      => __('Specify the excerpt length for blog.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'required'      => array('blog_excerpt', 'equals', '1'),
                        'default'       => 60,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 150,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'blog_read_more_button',
                        'type'      => 'switch',
                        'title'     => __('Blog Read More Button', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post read more button for blog.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'    => 'single_post_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Single Post Options', 'themepixels' )
                    ),

                    array(
                        'id'        => 'single_post_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar Position', 'themepixels'),
                        'subtitle'  => __('Select sidebar position for single posts.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'default'  => array('alt' => 'Default', 'img' => $themepixels_admin_img_dir . 'default-sidebar.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $themepixels_admin_img_dir . 'right-sidebar.png'),
                            'left-sidebar'  => array('alt' => 'Left Sidebar', 'img' => $themepixels_admin_img_dir . 'left-sidebar.png'),
                            'both-sidebar'  => array('alt' => 'Both Sidebar', 'img' => $themepixels_admin_img_dir . 'both-sidebar.png'),
                            'no-sidebar'    => array('alt' => 'No Sidebar', 'img' => $themepixels_admin_img_dir . 'no-sidebar.png')
                        ),
                        'default'   => 'default'
                    ),

                    array(
                        'id'        => 'enable_post_header_single',
                        'type'      => 'switch',
                        'title'     => __('Post Header', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post header for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_meta_single',
                        'type'      => 'switch',
                        'title'     => __('Post Meta', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post meta for single posts.', 'themepixels'),
                        'required'  => array('enable_post_header_single', 'equals', '1'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'post_meta_links_single',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Post Meta Links', 'themepixels'),
                        'subtitle'  => __('Check which meta links to show for single posts.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('enable_post_meta_single', 'equals', '1'),
                        'options'   => array(
                            'author'    => __( 'Author','themepixels' ),
                            'date'      => __( 'Date','themepixels' ),
                            'views'     => __( 'Views','themepixels' ),
                            'likes'     => __( 'Likes','themepixels' ),
                            'comments'  => __( 'Comments','themepixels' ),
                        ),
                        'default'   => array(
                            'author'    => true,
                            'date'      => true,
                            'views'     => true,
                            'likes'     => true,
                            'comments'  => true,
                        )
                    ),

                    array(
                        'id'        => 'enable_featured_content_single',
                        'type'      => 'switch',
                        'title'     => __('Post Featured Content', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable featured content for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_category_single',
                        'type'      => 'switch',
                        'title'     => __('Post Categories', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post categories for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_tags_single',
                        'type'      => 'switch',
                        'title'     => __('Post Tags', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post tags for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_author_info_single',
                        'type'      => 'switch',
                        'title'     => __('Author Info Box', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable author info box for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_post_related_single',
                        'type'      => 'switch',
                        'title'     => __('Related Posts', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable related posts for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'            => 'related_posts_count',
                        'type'          => 'slider',
                        'title'         => __('Number of related posts', 'themepixels'),
                        'subtitle'      => __('Choose the number of posts you want to show in related posts.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'required'      => array('enable_post_related_single', 'equals', '1'),
                        'default'       => 4,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 20,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'enable_post_next_prev_links_single',
                        'type'      => 'switch',
                        'title'     => __('Next / Previous Posts Links', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable next/prev navigation for single posts.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Page Options
            **/
            $this->sections[] = array(
                'title'     => __( 'Page Options', 'themepixels' ),
                'heading'   => __( 'Page Options', 'themepixels' ),
                'desc'      => __( '', 'themepixels' ),
                'icon'      => 'el-icon-pencil',
                'submenu'   => true,
                'fields'    => array(

                    array(
                        'id'        => 'page_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar Position', 'themepixels'),
                        'subtitle'  => __('Select sidebar position for pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'default'  => array('alt' => 'Default', 'img' => $themepixels_admin_img_dir . 'default-sidebar.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $themepixels_admin_img_dir . 'right-sidebar.png'),
                            'left-sidebar'  => array('alt' => 'Left Sidebar', 'img' => $themepixels_admin_img_dir . 'left-sidebar.png'),
                            'both-sidebar'  => array('alt' => 'Both Sidebar', 'img' => $themepixels_admin_img_dir . 'both-sidebar.png'),
                            'no-sidebar'    => array('alt' => 'No Sidebar', 'img' => $themepixels_admin_img_dir . 'no-sidebar.png')
                        ),
                        'default'   => 'default'
                    ),

                    array(
                        'id'        => 'enable_page_header',
                        'type'      => 'switch',
                        'title'     => __('Page Header', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable page header.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_page_meta',
                        'type'      => 'switch',
                        'title'     => __('Page Meta', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable page meta.', 'themepixels'),
                        'required'  => array('enable_page_header', 'equals', '1'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'page_meta_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Page Meta Links', 'themepixels'),
                        'subtitle'  => __('Check which meta links to show for pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('enable_page_meta', 'equals', '1'),
                        'options'   => array(
                            'author'    => __( 'Author','themepixels' ),
                            'date'      => __( 'Date','themepixels' ),
                            'views'     => __( 'Views','themepixels' ),
                            'likes'     => __( 'Likes','themepixels' ),
                            'comments'  => __( 'Comments','themepixels' ),
                        ),
                        'default'   => array(
                            'author'    => true,
                            'date'      => true,
                            'views'     => true,
                            'likes'     => true,
                            'comments'  => true,
                        )
                    ),

                    array(
                        'id'        => 'enable_page_featured_image',
                        'type'      => 'switch',
                        'title'     => __('Page Featured Image', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable page featured image.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_page_comments',
                        'type'      => 'switch',
                        'title'     => __('Page Comments', 'themepixels'),
                        'subtitle'  => __('Show Comments for pages.', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Search
            **/
            $this->sections[] = array(
                'title'         => __( 'Search', 'themepixels' ),
                'heading'       => __( 'Search', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                'icon'          => 'el-icon-search',
                'submenu'       => true,
                'fields'        => array(

                    array(
                        'id'        => 'search_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar Position', 'themepixels'),
                        'subtitle'  => __('Select sidebar position for search pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'default'  => array('alt' => 'Default', 'img' => $themepixels_admin_img_dir . 'default-sidebar.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $themepixels_admin_img_dir . 'right-sidebar.png'),
                            'left-sidebar'  => array('alt' => 'Left Sidebar', 'img' => $themepixels_admin_img_dir . 'left-sidebar.png'),
                            'both-sidebar'  => array('alt' => 'Both Sidebar', 'img' => $themepixels_admin_img_dir . 'both-sidebar.png'),
                            'no-sidebar'    => array('alt' => 'No Sidebar', 'img' => $themepixels_admin_img_dir . 'no-sidebar.png')
                        ),
                        'default'   => 'default'
                    ),

                    array(
                        'id'        => 'search_layout',
                        'type'      => 'image_select',
                        'title'     => __('Search Layout', 'themepixels'),
                        'subtitle'  => __('Select the layout for the search pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'style-1'   => array('alt' => 'Blog 1 Column', 'img' => $themepixels_admin_img_dir . '1col.png'),
                            'style-2'   => array('alt' => 'Masonry 2 Columns', 'img' => $themepixels_admin_img_dir . '2col.png'),
                            'style-3'   => array('alt' => 'Masonry 3 Columns', 'img' => $themepixels_admin_img_dir . '3col.png')
                        ),
                        'default'   => 'style-1'
                    ),

                    array(
                        'id'        => 'search_pagination_type',
                        'type'      => 'select',
                        'title'     => __('Pagination Type', 'themepixels'),
                        'subtitle'  => __('Choose your pagination type.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'options'   => array(
                            'numbered-pagination'       => __( 'Numbered Pagination','themepixels' ),
                            'next-prev'                 => __( 'Next/Prev','themepixels' )
                        ),
                        'default'   => 'numbered-pagination',
                        'select2'   => array( 'allowClear' => false ),
                    ),

                    array(
                        'id'        => 'enable_search_post_header',
                        'type'      => 'switch',
                        'title'     => __('Search Results Post Header', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post header for search results.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'enable_search_post_meta',
                        'type'      => 'switch',
                        'title'     => __('Search Results Post Meta', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post meta for search results.', 'themepixels'),
                        'required'  => array('enable_search_post_header', 'equals', '1'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'search_post_meta_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Search Results Post Meta Links', 'themepixels'),
                        'subtitle'  => __('Check which meta links to show for search results.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('enable_search_post_meta', 'equals', '1'),
                        'options'   => array(
                            'author'    => __( 'Author','themepixels' ),
                            'date'      => __( 'Date','themepixels' ),
                            'views'     => __( 'Views','themepixels' ),
                            'likes'     => __( 'Likes','themepixels' ),
                            'comments'  => __( 'Comments','themepixels' ),
                        ),
                        'default'   => array(
                            'author'    => true,
                            'date'      => true,
                            'views'     => true,
                            'likes'     => true,
                            'comments'  => true,
                        )
                    ),

                    array(
                        'id'        => 'enable_search_featured_image',
                        'type'      => 'switch',
                        'title'     => __('Search Results Featured Image', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable post featured image for search results.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'search_excerpt',
                        'type'      => 'switch',
                        'title'     => __('Search Results Excerpt', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable auto excerpts for search results.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'            => 'search_excerpt_length',
                        'type'          => 'slider',
                        'title'         => __('Search Results Excerpt Length', 'themepixels'),
                        'subtitle'      => __('Specify the excerpt length for search results.', 'themepixels'),
                        'desc'          => __('', 'themepixels'),
                        'required'      => array('search_excerpt', 'equals', '1'),
                        'default'       => 60,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 150,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'search_read_more_button',
                        'type'      => 'switch',
                        'title'     => __('Read More Button', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable read more button for search results.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                ),
            );

            /**
                Social Sharing
            **/
            $this->sections[] = array(
                'title'         => __( 'Social Sharing', 'themepixels' ),
                'heading'       => __( 'Social Sharing', 'themepixels' ),
                'desc'          => __( '', 'themepixels' ),
                'icon'          => 'el-icon-twitter',
                'submenu'       => true,
                'fields'        => array(

                    array(
                        'id'        => 'social_sharing_link_target',
                        'type'      => 'switch',
                        'title'     => __('Open links in new window', 'themepixels'),
                        'subtitle'  => __('Open social sharing links in new window', 'themepixels'),
                        'default'   => 0,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'    => 'blog_sharing_icons_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Blog - Normal Layout', 'themepixels' )
                    ),

                    array(
                        'id'        => 'blog_social_share',
                        'type'      => 'switch',
                        'title'     => __('Social share ( Blog - Normal )', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable blog social share.', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'blog_social_sharing_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Social Sharing Links', 'themepixels'),
                        'subtitle'  => __('Check which sharing icon to show for blog.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('blog_social_share', 'equals', '1'),
                        'options'   => array(
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'googleplus'    => __( 'Google Plus','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'digg'          => __( 'Digg','themepixels' ),
                            'reddit'        => __( 'Reddit','themepixels' ),
                            'stumbleupon'   => __( 'Stumbleupon','themepixels' ),
                            'delicious'     => __( 'Delicious','themepixels' ),
                            'email'         => __( 'Email','themepixels' ),
                        ),
                        'default'   => array(
                            'facebook'      => true,
                            'twitter'       => true,
                            'googleplus'    => true,
                            'pinterest'     => true,
                            'linkedin'      => true,
                            'digg'          => true,
                            'reddit'        => false,
                            'stumbleupon'   => false,
                            'delicious'     => false,
                            'email'         => true,
                        )
                    ),

                    array(
                        'id'    => 'blog_masonry_sharing_icons_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Blog - Grid Layout', 'themepixels' )
                    ),

                    array(
                        'id'        => 'blog_masonry_social_share',
                        'type'      => 'switch',
                        'title'     => __('Social share ( Blog - Grid )', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable blog grid social share', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'blog_masonry_social_sharing_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Social Sharing Links', 'themepixels'),
                        'subtitle'  => __('Check which sharing icon to show for blog grid.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('blog_masonry_social_share', 'equals', '1'),
                        'options'   => array(
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'googleplus'    => __( 'Google Plus','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'digg'          => __( 'Digg','themepixels' ),
                            'reddit'        => __( 'Reddit','themepixels' ),
                            'stumbleupon'   => __( 'Stumbleupon','themepixels' ),
                            'delicious'     => __( 'Delicious','themepixels' ),
                            'email'         => __( 'Email','themepixels' ),
                        ),
                        'default'   => array(
                            'facebook'      => true,
                            'twitter'       => true,
                            'googleplus'    => true,
                            'pinterest'     => true,
                            'linkedin'      => true,
                            'digg'          => false,
                            'reddit'        => false,
                            'stumbleupon'   => false,
                            'delicious'     => false,
                            'email'         => false,
                        )
                    ),

                    array(
                        'id'    => 'blog_single_sharing_icons_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Blog - Single Posts', 'themepixels' )
                    ),

                    array(
                        'id'        => 'single_posts_social_share',
                        'type'      => 'switch',
                        'title'     => __('Social share ( Blog - Single )', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable single post social share', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'single_posts_social_sharing_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Social Sharing Links', 'themepixels'),
                        'subtitle'  => __('Check which sharing icon to show for blog single posts.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('single_posts_social_share', 'equals', '1'),
                        'options'   => array(
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'googleplus'    => __( 'Google Plus','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'digg'          => __( 'Digg','themepixels' ),
                            'reddit'        => __( 'Reddit','themepixels' ),
                            'stumbleupon'   => __( 'Stumbleupon','themepixels' ),
                            'delicious'     => __( 'Delicious','themepixels' ),
                            'email'         => __( 'Email','themepixels' ),
                        ),
                        'default'   => array(
                            'facebook'      => true,
                            'twitter'       => true,
                            'googleplus'    => true,
                            'pinterest'     => true,
                            'linkedin'      => true,
                            'digg'          => true,
                            'reddit'        => false,
                            'stumbleupon'   => false,
                            'delicious'     => false,
                            'email'         => true,
                        )
                    ),

                    array(
                        'id'    => 'pages_sharing_icons_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Page', 'themepixels' )
                    ),

                    array(
                        'id'        => 'pages_social_share',
                        'type'      => 'switch',
                        'title'     => __('Social share ( Pages )', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable pages social share', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'pages_social_sharing_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Social Sharing Links', 'themepixels'),
                        'subtitle'  => __('Check which sharing icon to show for pages.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('pages_social_share', 'equals', '1'),
                        'options'   => array(
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'googleplus'    => __( 'Google Plus','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'digg'          => __( 'Digg','themepixels' ),
                            'reddit'        => __( 'Reddit','themepixels' ),
                            'stumbleupon'   => __( 'Stumbleupon','themepixels' ),
                            'delicious'     => __( 'Delicious','themepixels' ),
                            'email'         => __( 'Email','themepixels' ),
                        ),
                        'default'   => array(
                            'facebook'      => true,
                            'twitter'       => true,
                            'googleplus'    => true,
                            'pinterest'     => true,
                            'linkedin'      => true,
                            'digg'          => true,
                            'reddit'        => false,
                            'stumbleupon'   => false,
                            'delicious'     => false,
                            'email'         => true,
                        )
                    ),

                    array(
                        'id'    => 'search_pages_sharing_icons_info',
                        'type'  => 'info',
                        'style' => 'info',
                        'title' => __( 'Search Page', 'themepixels' )
                    ),

                    array(
                        'id'        => 'search_pages_social_share',
                        'type'      => 'switch',
                        'title'     => __('Social share ( Search Page )', 'themepixels'),
                        'subtitle'  => __('Check if you want to enable search page social share', 'themepixels'),
                        'default'   => 1,
                        'on'        => __( 'On', 'themepixels' ),
                        'off'       => __( 'Off', 'themepixels' ),
                    ),

                    array(
                        'id'        => 'search_pages_social_sharing_links',
                        'type'      => 'sortable',
                        'mode'      => 'checkbox',
                        'title'     => __('Social Sharing Links', 'themepixels'),
                        'subtitle'  => __('Check which sharing icon to show for search page.', 'themepixels'),
                        'desc'      => __('', 'themepixels'),
                        'required'  => array('search_pages_social_share', 'equals', '1'),
                        'options'   => array(
                            'facebook'      => __( 'Facebook','themepixels' ),
                            'twitter'       => __( 'Twitter','themepixels' ),
                            'googleplus'    => __( 'Google Plus','themepixels' ),
                            'pinterest'     => __( 'Pinterest','themepixels' ),
                            'linkedin'      => __( 'Linkedin','themepixels' ),
                            'digg'          => __( 'Digg','themepixels' ),
                            'reddit'        => __( 'Reddit','themepixels' ),
                            'stumbleupon'   => __( 'Stumbleupon','themepixels' ),
                            'delicious'     => __( 'Delicious','themepixels' ),
                            'email'         => __( 'Email','themepixels' ),
                        ),
                        'default'   => array(
                            'facebook'      => true,
                            'twitter'       => true,
                            'googleplus'    => true,
                            'pinterest'     => true,
                            'linkedin'      => true,
                            'digg'          => true,
                            'reddit'        => false,
                            'stumbleupon'   => false,
                            'delicious'     => false,
                            'email'         => true,
                        )
                    ),

                ),
            );

            /**
                Import / Export
            **/
            $this->sections[] = array(
                'title'  => __( 'Import / Export', 'themepixels' ),
                'desc'   => __( '', 'themepixels' ),
                'icon'   => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id'         => 'opt-import-export',
                        'type'       => 'import_export',
                        'title'      => 'Import Export',
                        'subtitle'   => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );
        }

        /**
            All the possible arguments for Redux.
            For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
        **/
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'             => 'themepixels_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'      => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'            => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'           => __( 'Theme Options', 'themepixels' ),
                'page_title'           => __( 'Smart Blog Options', 'themepixels' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => 'AIzaSyCCWQT7Pq0wVLz33xGwFk0jj4LkqMBKjlg',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => false,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'     => 'dashicons-admin-generic',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable'      => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'             => false,
                // Show the time the page took to load, etc
                'update_notice'        => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'           => false,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => '',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => 'smart_blog_options',
                // Page slug used to denote the panel
                'save_defaults'        => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'         => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'         => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'   => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'       => 60 * MINUTE_IN_SECONDS,
                'output'               => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'           => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'          => false,
                // REMOVE

                // HINTS
                'hints'                => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'dark',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_smart_blog_config();
}