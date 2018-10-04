<div class="container-invis woocommerce product-loop-style2">
        <?php
		if ( $posts->have_posts() ) {
			$section_title = $posts->data['section_title'];
			$show_view_all = $posts->data['show_view_all'];
			$show_all_features_car = $posts->data['show_all_features_car'];
			?>
            <div class="list-wrapper products clearfix">
                <div class="section-title clearfix">
                    <h3><?php echo esc_html($section_title); ?> 
                    <?php if($show_view_all == 'yes'): 
					$view_all_text = $posts->data['view_all_text'];
					$view_all_link = $posts->data['view_all_link'];
					?>
                    <small><a href="<?php echo esc_url($view_all_link); ?>"><?php echo esc_html($view_all_text); ?> <i class="fa fa-angle-right"></i></a></small>
                    <?php endif; ?>
                    </h3>
                </div><!-- end section-title -->
                <div class="row">
                <?php
                // Posts are found
					$i = 1;
                    while ( $posts->have_posts() ) :
                        $posts->the_post();
                        global $post;
						global $product;
                        ?>
                    <div class="col-md-4 wow fadeIn margin-bottom-content" data-wow-duration="1s" data-wow-delay="0.<?php echo esc_attr($i); ?>s">
                    	<div class="car-wrapper clearfix">
                            <div class="post-media entry">
                                <?php
                                truvatour_post_thumb(940, 500);
                                ?>
                                <div class="magnifier">
                                </div><!-- end magnifier -->
                                <div class="car-price"><p><?php echo wp_kses($product->get_price_html(), array('p'=>array('class'=>array()), 'del'=>array('class'=>array()), 'ins'=>array('class'=>array()), 'span'=>array('class'=>array()))); ?></p></div>
                                <?php if($show_all_features_car == 'yes'): ?>
                                <ul class="list-inline">
                                <?php if(get_post_meta(get_the_ID(), 'car_features_speed', true ) != ''): ?>
                                    <li class="car-km"><p><i class="fa fa-road"></i> <?php echo get_post_meta(get_the_ID(), 'car_features_speed', true ); ?></p></li>
                                <?php endif; ?>
                                <?php if(get_post_meta(get_the_ID(), 'car_features_fuel', true ) != ''): ?>
                                    <li class="car-oil"><p><i class="fa fa-car"></i> <?php echo get_post_meta(get_the_ID(), 'car_features_fuel', true ); ?></p></li>
                                <?php endif; ?>
                                <?php if(get_post_meta(get_the_ID(), 'car_features_model', true ) != ''): ?>
                                    <li class="car-date"><p><i class="fa fa-clock-o"></i> <?php echo get_post_meta(get_the_ID(), 'car_features_model', true ); ?></p></li>
                                <?php endif; ?>
                                </ul>
                                <?php endif; ?>
                            </div><!-- end post-media -->

                            <div class="car-title clearfix">
                                <h4><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
                            </div><!-- end car-title -->
                        </div>
                    </div><!-- end col -->
                    <?php
					$i++;
                    endwhile;
                ?>     
                </div><!-- end row -->
            </div><!-- end list-wrapper -->
            <?php
            }
            // Posts not found
            else { ?>
            <h4><?php echo esc_html__( 'Product not found', 'truvatour' ); ?></h4>
            <?php } ?>
</div>