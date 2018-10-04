<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
	<?php $blog_style = (function_exists('ot_get_option'))? ot_get_option( 'blog_style', 'default' ) : 'default';
		$blog_layout = (function_exists('ot_get_option'))? ot_get_option( 'blog_layout', 'rs' ) : 'rs';
	$width = 1200;
	$height = 600;
	$crop = false;
	$class2 = '';
	$class3 = '';
	if($blog_style == 'grid_view'):
		if($blog_layout == 'full'):
			$class = ' col-md-4 grid-view';
		else:
			$class = ' col-md-6 grid-view';
		endif;
	elseif($blog_style == 'list_view'):
		$class = ' row';
		if($blog_layout == 'full'):
			$class2 = ' col-md-3';
			$class3 = ' col-md-9';
		else:
			$class2 = ' col-md-5';
			$class3 = ' col-md-7';
		endif;
		if(!is_single()):
		$width = 400;
		$height = 400;
		$crop = true;
		endif;	
	else:
		$class = '';
	endif;
	?>
	<div class="blog-item<?php echo esc_attr($class); ?>">
    	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>  
            <div class="post-meta sticky-posts">                
                <?php $sticky_post_text = (function_exists('ot_get_option'))? ot_get_option( 'sticky_post_text', 'Featured' ) : esc_html__('Featured', 'truvatour'); ?>                
                <div class="sticky-content"><?php printf( '<span class="sticky-post">%s</span>', $sticky_post_text ); ?></div>                
            </div>            
        <?php endif; ?>
        <?php if($blog_style == 'list_view' && !is_single()):?>
        <div class="<?php echo esc_attr($class2); ?>">
        <?php endif; ?>
        <div class="post-media">
        	<?php
			$video_url = get_post_meta( get_the_ID(), '_format_video_embed', true );				
			if( $video_url != '' ):							
				echo do_shortcode(wp_kses_post('[ts_custom_video url="'.esc_url($video_url).'"]'));											
			endif;
			?>
        	<?php if(!is_single()): ?>
                <a href="<?php esc_url(the_permalink()); ?>" title="">
                <?php truvatour_post_thumb( $width, $height, true, $crop ); ?>
                </a>
            <?php else: ?>
            	<?php truvatour_post_thumb( $width, $height, true, $crop ); ?>
            <?php endif; ?>
        </div><!-- end media -->
        <?php if($blog_style == 'list_view' && !is_single()):?>
        </div>
        <div class="<?php echo esc_attr($class3); ?>">
        <?php endif; ?>
        <div class="blog-meta">
            <ul class="list-inline">
            	<?php if(!is_single()): ?>
                <li><a href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></a></li>
                <?php else: ?>
                <li><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></li>
                <?php endif; ?>
                <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i> <?php echo get_the_author(); ?></a></li>
                <li><a href="<?php esc_url(comments_link()); ?>"><i class="fa fa-comments-o"></i> <?php comments_number( "0", "1", "%" ) ?></a></li>
                <?php if(function_exists('pvc_get_post_views')): ?>
                <li><a href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-eye"></i> <?php echo wp_kses(pvc_get_post_views( get_the_ID() ), array('span'=>array())); ?></a></li>
                <?php endif; ?>                
                <li><i class="fa fa-folder-open-o"></i> <?php the_category(', '); ?></li>
            </ul><!-- end inline -->
            <?php if(!is_single()): ?>
            <h4><a href="<?php esc_url(the_permalink()); ?>" title=""><?php the_title(); ?></a></h4>
            <?php else: ?>
            <h4><?php the_title(); ?></h4>
            <?php endif; ?>
            <?php if ( is_search()) : ?>                
                <p><?php the_excerpt(); ?></p>                        
            <?php else : ?>                    
                <?php the_content(sprintf(esc_html__( 'Read More', 'truvatour' ) ) ); ?>                        
            <?php endif; ?>
        </div><!-- end blog-meta -->
        <?php if($blog_style == 'list_view' && !is_single()):?>
        </div>
        <?php endif; ?>
        <?php
		if(is_single()):
			wp_link_pages( array(				
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'truvatour' ) . '</span>',					
				'after'       => '</div>',					
				'link_before' => '<span>',					
				'link_after'  => '</span>',					
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'truvatour' ) . ' </span>%',					
				'separator'   => '<span class="screen-reader-text">, </span>',					
			) );
							
			$tags_list = get_the_tag_list('<ul class="list-inline cat_list"><li>','</li><li>','</li></ul>');					
			if ( $tags_list ): ?>					
				<div class="blog-tags">				
					<?php echo wp_kses( 							
					  $tags_list,							  
					  // Only allow a tag							  
					  array(
					  'ul' => array(								
						  'class' => array()								  
						),
						'li' => array(								
						  'class' => array()							  
						),								
						'a' => array(								
						  'href' => array()								  
						),								
					  )							  
					); ?>						
				</div>						
			<?php					 
			endif;		
			?>
            <hr>
            <?php truvatour_social_share(); ?>
            <?php				
		endif;				
		?>
    </div><!-- end blog-item -->
</div><!-- end content -->