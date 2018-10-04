<?php
/**
 * Template Name: Coming Soon Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in prestige consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage TruvaTour
 * @since TruvaTour 1.0.0
 */
?>
<?php
/**
 * The Header for multipage of theme
 *
 * Displays all of the <head> section and everything up till </header>
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- LOADER -->
    <div id="preloader">
    	<?php $preloader = (function_exists('ot_get_option'))? ot_get_option( 'preloader', TRUVATOURTHEMEURI. '/images/loader.gif' ) : TRUVATOURTHEMEURI. '/images/loader.gif'; ?>
        <img class="preloader" src="<?php echo esc_url($preloader); ?>" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->
    
    <!-- ******************************************
    START SITE HERE
    ********************************************** -->
	<div id="wrapper">
    <section id="comingsoon">
        <div class="js-height-full">
            <div class="home-text-wrapper container">
                <div class="home-message">
                	<?php
					$title = get_the_title();
					$subtitle = '';
					$custom_title = get_post_meta( get_the_ID(), 'custom_title', true );
					if( $custom_title == 'on' ){
						$alt_title = get_post_meta( get_the_ID(), 'title', true );
						$title = ( $alt_title != '' )? $alt_title : $title;
				
						$alt_subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
						$subtitle = ( $alt_subtitle != '' )? $alt_subtitle : $subtitle;
					}
					?>
                    <p class="parallax-text-22"><?php echo esc_html($title); ?></p>
                    <p class="lead"><?php echo wp_kses($subtitle, array('p'=>array())); ?></p>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div id="countdown1"></div>
                        </div>
                    </div>
                    <?php
					// Start the loop.
					while ( have_posts() ) : the_post();
				
						// Include the page content template.
						the_content();
				
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
				
					// End the loop.
					endwhile;
					?>
                </div>
            </div>
        </div>
    </section>
 </div><!-- end wrapper -->
<?php wp_footer(); ?>  
</body>
</html>