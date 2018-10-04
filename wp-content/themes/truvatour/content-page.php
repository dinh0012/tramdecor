<div class="content-page blog-item">
	<div class="post-padding clearfix">
	<?php the_content(); ?>    
    <?php	
	wp_link_pages( array(	
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'truvatour' ) . '</span>',		
		'after'       => '</div>',		
		'link_before' => '<span>',		
		'link_after'  => '</span>',		
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'truvatour' ) . ' </span>%',		
		'separator'   => '<span class="screen-reader-text">, </span>',		
	) );	
	?>
    </div>    
</div>
