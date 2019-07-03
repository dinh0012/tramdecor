<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="main-wrapper clearfix">
    <div id="main" role="main">
        <div class="wth_theme_main">
            <section class="new_page">
                <div class="row">
                    <div class="col">
                        <?php
                        // Start the loop.
                        while (have_posts()) : the_post();
                            ?>
                            <div class="main-content">
                                <?php the_content() ?>
                            </div>
                            <?php
                        endwhile;
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </div><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
