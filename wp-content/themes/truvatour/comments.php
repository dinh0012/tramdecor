<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to truvatour_comments() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage TruvaTour
 * @since TruvaTour 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<?php if ( have_comments() || comments_open() ) : ?>

<div class="blog-item">
	
    <?php if ( have_comments() ) : ?>
    
    	<h3 class="car-single-title">
            <i class="flaticon-avatar"></i> <?php comments_number( esc_html__('Comments (0)', 'truvatour'), esc_html__('Comment (1)', 'truvatour'), esc_html__('Comments (%)', 'truvatour') ); ?>
        </h3>
       
        <div class="comments-list">	
            <ol class="media-list"><?php wp_list_comments( array( 'callback' => 'truvatour_comments', 'style' => 'ol', 'short_ping'  => true ) ); ?></ol><!-- .commentlist -->
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>	
            <nav id="comment-nav-below" class="navigation">	
                <h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'truvatour' ); ?></h1>		
                <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'truvatour' ) ); ?></div>		
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'truvatour' ) ); ?></div>		
            </nav>	
            <?php endif; // check for comment navigation ?>	
            <?php
            /* If there are no comments and comments are closed, let's leave a note.
             * But we only want the note on posts and pages that had comments in the first place.
             */	 
            if ( ! comments_open() && get_comments_number() ) : ?>	
                <p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'truvatour' ); ?></p>	
            <?php endif; ?>	
        </div>
        <hr>
        <?php endif; // have_comments() ?>
		

    <?php if ( comments_open() ) : ?>
		<?php truvatour_comment_form(); ?>	
    <?php endif; ?>
</div>
<?php endif; ?>
