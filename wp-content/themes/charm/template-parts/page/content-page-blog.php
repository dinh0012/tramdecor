<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="wth_theme_main">
		<div class="container">
			<div class="row">
                <div class="col-md-8">
                    <?php
                        the_content();
                    ?>
			    </div>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
