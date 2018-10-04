<div class="container-invis woocommerce product-carousel-lists">
        <?php
		if ( $posts->have_posts() ) {
			$section_title = $posts->data['section_title'];
			$show_view_all = $posts->data['show_view_all'];
			$show_all_features = $posts->data['show_all_features'];
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
                <div class="owl-hotels owl-carousel owl-theme owl-custom">
                <?php
                // Posts are found
                    while ( $posts->have_posts() ) :
                        $posts->the_post();
                        global $post;
						global $product;
                        ?>
                    <div class="owl-item">
                        <div class="list-item">
                            <a href="<?php esc_url(the_permalink()); ?>" title="">
                            <div class="entry">
                                <?php
                                truvatour_post_thumb(1000, 550);
                                ?>
                                
                                <div class="magnifier">
                                    <div class="magni-desc">
                                    <?php
									if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
										return;
									?>			
									<?php if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) : ?>
										
										<div class="rating">
										<small><?php echo sprintf(esc_html__('%d (Reviews)', 'truvatour'), $product->get_review_count()); ?></small>
										<?php echo wp_kses($rating_html, array('div'=>array('class'=>array(), 'title'=>array()), 'span'=>array('class'=>array()), 'strong'=>array('class'=>array()))); ?>
										</div>
									<?php endif; ?>
                                    </div>
                                </div><!-- end magnifier -->
                            </div><!-- end entry -->
                            </a>
                            
                            <?php if($show_all_features == 'yes'): ?>
                            <div class="list-categories clearfix">
                                <ul>
                                	<?php if(get_post_meta(get_the_ID(), 'product_feature_airplane', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Airplane', 'truvatour'); ?>"><i class="flaticon-air-transport"></i></a></li>
                                    <?php else: ?>
                                    <li><i class="flaticon-air-transport"></i></li>
                                    <?php endif; ?>
                                    
                                    <?php if(get_post_meta(get_the_ID(), 'product_feature_accommodation', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Accommodation', 'truvatour'); ?>"><i class="flaticon-rural-hotel-building"></i></a></li>
                                    <?php else: ?>
                                    <li><i class="flaticon-rural-hotel-building"></i></li>
									<?php endif; ?>
                                    
                                    <?php if(get_post_meta(get_the_ID(), 'product_feature_walking', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Walking', 'truvatour'); ?>"><i class="flaticon-sneaker-shoe-outline-of-fashion-walking-tool"></i></a></li>
                                    <?php else: ?>
                                    <li><i class="flaticon-sneaker-shoe-outline-of-fashion-walking-tool"></i></li>
                                    <?php endif; ?>
                                    
                                    <?php if(get_post_meta(get_the_ID(), 'product_feature_wildlife', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Wildlife', 'truvatour'); ?>"><i class="flaticon-lion"></i></a></li>
                                     <?php else: ?>
                                     <li><i class="flaticon-lion"></i></li>
									<?php endif; ?>
                                    
                                    <?php if(get_post_meta(get_the_ID(), 'product_feature_watersport', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Water Sports', 'truvatour'); ?>"><i class="flaticon-surfing"></i></a></li>
                                     <?php else: ?>
                                     <li><i class="flaticon-surfing"></i></li>
									<?php endif; ?>
                                    
                                    <?php if(get_post_meta(get_the_ID(), 'product_feature_meal', true) == 'yes'): ?>
                                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__('Meal', 'truvatour'); ?>"><i class="flaticon-restaurant-utensils-crossed"></i></a></li>
                                    <?php else: ?>
                                    <li><i class="flaticon-restaurant-utensils-crossed"></i></li>
									<?php endif; ?>
                                </ul><!-- end ul -->
                            </div><!-- end list-cats -->
                            
                            <?php endif; ?>

                            <div class="list-desc clearfix">
                                <h4><a href="<?php esc_url(the_permalink()); ?>" title=""><?php esc_attr(the_title()); ?></a></h4>
                                <ul class="list-inline">
									<?php
                                    $terms = get_the_terms( $post->ID, 'product_cat' );
                                    if($terms): ?>
                                    <li class="small">
                                    <?php
                                    foreach ($terms as $term) { ?>
                                        <span><?php echo esc_html($term->name); ?></span>
                                    <?php	
                                    }
                                    ?>
                                    </li>
                                    <?php
                                    endif;
                                    ?>
                                    <?php if(get_post_meta($post->ID, 'product_country', true) != ''): ?>           
                                    <li class="small"><?php echo esc_html__('From: ', 'truvatour'); ?> <span class="product-country"><?php echo get_post_meta($post->ID, 'product_country', true); ?></span></li>
                                    <?php endif; ?>
                                </ul>
                                <ul class="list-bottom list-inline">
									<?php
                                    $regular_price = get_post_meta( $post->ID, '_regular_price', true);
                                    $sales_price = get_post_meta( $post->ID, '_price', true);
                                    if($sales_price != ''):			
                                        $discount_price = $regular_price - $sales_price;			
                                        $final_price = round($discount_price*100/$regular_price);
                                    ?>
                                    <li><sub><?php echo esc_html($final_price); ?>%</sub> <?php echo esc_html__('Discounts', 'truvatour'); ?></li>
                                    <?php endif; ?>
                                    <?php if ( $price_html = $product->get_price_html() ) : ?>
                                        <li class="price"><?php echo wp_kses($price_html, array('p'=>array('class'=>array()), 'del'=>array('class'=>array()), 'ins'=>array('class'=>array()), 'span'=>array('class'=>array()))); ?></li>
                                    <?php endif; ?>
                                    <li class="read-more-details"><a href="<?php esc_url(the_permalink()); ?>" class="readmore"><?php echo esc_html__('View details', 'truvatour'); ?> <i class="fa fa-angle-right"></i></a></li>
                                </ul><!-- end list-bottom -->
                            </div><!-- end list-desc -->
                        </div><!-- end list-item -->
                    </div><!-- end col -->
                    <?php
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