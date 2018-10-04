<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage TruvaTour
 * @since TruvaTour 1.0.0
 */
 
?>
<?php $description = get_the_author_meta( 'description' ); ?>
<?php if($description != ''): ?>
<div class="blog-item">
    <div class="authorbox">
        <?php		
		$author_bio_avatar_size = apply_filters( 'truvatour_author_bio_avatar_size', 120 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, null, null, array( 'class' => array( 'img-responsive', 'img-circle' ) ) );
		?>
        <h4><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="">
        <?php echo get_the_author(); ?></a></h4>
        <p><?php the_author_meta( 'description' ); ?></p>

        <div class="authorbox-social">
            <ul class="list-inline">
                <?php if(get_the_author_meta('twitter') != ''): ?>
                	<li><a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>
            </ul><!-- end list -->
        </div><!-- end share -->
    </div><!-- end publisher -->
</div><!-- end details -->
<?php endif; ?>