<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage TruvaTour
 * @since TruvaTour 1.0.0
 */

get_header(); ?>
<div class="container">
    <div class="content clearfix">
        <div class="row intro blog-item">
            <div class="col-md-7 text-left">
                <h2><?php echo esc_html__('404', 'truvatour'); ?></h2>
                <h1><?php echo esc_html__('Oh no! Page Not Found', 'truvatour'); ?></h1>
                <p><?php echo esc_html__('The page you are looking for no longer exists. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for. Or, you can try finding it with the information below. Please click below link or click on site logo to return home page.', 'truvatour'); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php echo esc_html__('Back to Home', 'truvatour'); ?></a>
            </div><!-- end col -->

            <div class="col-md-5">
                <img src="<?php echo TRUVATOURTHEMEURI; ?>images/404.png" alt="" class="img-responsive">
            </div>
        </div>
    </div><!-- end search-top -->
</div>            
<?php get_footer(); ?>