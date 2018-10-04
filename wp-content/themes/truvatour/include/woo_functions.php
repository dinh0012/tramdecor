<?php
// woocommerce functions
add_filter( 'woocommerce_page_title', 'truvatour_custom_woocommerce_title');
function truvatour_custom_woocommerce_title($page_title){
	return false;
}

add_filter('loop_shop_columns', 'truvatour_loop_columns');
if (!function_exists('truvatour_loop_columns')) {
	function truvatour_loop_columns() {
		$column_number = (function_exists('ot_get_option'))? ot_get_option('column_number', 3) : 3;
		return $column_number; // 3 products per row
	}
}

//removed sale flash action
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'truvatour_show_product_loop_sale_flash', 10 );

function truvatour_show_product_loop_sale_flash(){
	global $post, $product;
	?>
    <?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="ribbon"><span>' . esc_html__( 'Sale!', 'truvatour' ) . '</span></div>', $post, $product ); ?>

	<?php endif; ?>
    <?php
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'truvatour_template_loop_product_thumbnail', 10 );

function truvatour_template_loop_product_thumbnail($size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0){
	global $post;
	global $product;
	
	if ( has_post_thumbnail() ) {
		$image = truvatour_post_thumb( 1000, 550, false );
	} elseif ( wc_placeholder_img_src() ) {
		$image = wc_placeholder_img( $size );
	}
	?>
    <div class="entry">
    	<?php 
		echo wp_kses($image,array(
			'img' => array(
			  'src' => array(),
			  'alt' => array(),
			  'class' => array()
			),
		  ));
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
    </div>
    <?php
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'truvatour_template_loop_product_title', 10 );

function truvatour_template_loop_product_title(){
	global $post;
	global $product;
	?>
    <div class="list-desc clearfix">
        <h4><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title()); ?>"><?php the_title(); ?></a></h4>
        <ul class="list-inline">
        	<?php
			$terms = get_the_terms( $post->ID, 'product_cat' );
			if($terms): ?>
            <li class="small">
            <?php
			foreach ($terms as $term) { ?>
            	<a href="<?php echo esc_url( get_term_link( $term->slug, 'product_cat' ) ); ?>"><span><?php echo esc_html($term->name); ?></span></a>
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
                <li class="price"><?php echo wp_kses($price_html, array('p'=>array('class'=>array()), 'del'=>array('class'=>array()), 'ins'=>array('class'=>array()), 'span'=>array('class'=>array())));  ?></li>
            <?php endif; ?>
            <li class="read-more-details"><a href="<?php esc_url(the_permalink()); ?>" class="readmore"><?php echo esc_html__('View details', 'truvatour'); ?> <i class="fa fa-angle-right"></i></a></li>
        </ul><!-- end list-bottom -->
        
    </div>
    <?php
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product_summary', 'truvatour_show_product_sale_images', 10 );
add_action( 'woocommerce_single_product_summary', 'truvatour_show_product_description_end', 60 );

function truvatour_show_product_sale_images(){
	global $post;
	global $product;
	?>
    <div class="list-three-item restaurant-list">
    	<div class="list-item">
        	<?php 
			
			if(get_post_meta($post->ID, 'product_gallery_style', true) == 'flex_slider'): 
			?>
        	<div class="flexslider">
              <ul class="slides">
              	<?php if ( has_post_thumbnail() ) {
					$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$url_gal_1 = truvatour_image_resize( $fullsize[0], 940, 360, true, 'c', false );
              		$attachment_ids = $product->get_gallery_attachment_ids();
					$attachment_count = count( $product->get_gallery_attachment_ids() );
				 ?>
                <li data-thumb="<?php echo esc_url($url_gal_1); ?>">
                	<img src="<?php echo esc_url($url_gal_1); ?>" alt="">
                </li>
                <?php 
				if($attachment_count > 0){
				foreach ( $attachment_ids as $attachment_id ) {
					$props       = wc_get_product_attachment_props( $attachment_id, $post );
					$url_gal = truvatour_image_resize( $props['url'], 940, 360, true, 'c', false );
					?>
                <li data-thumb="<?php echo esc_url($url_gal); ?>">
                  <img src="<?php echo esc_url($url_gal); ?>" alt="">
                </li>
                <?php } ?>
                <?php } else{
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" class="img-responsive" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'truvatour' ) ), $post->ID );
				}
				}
				?>
              </ul>
            </div>
        	<?php else: ?>
            <?php if ( $product->is_on_sale() ) : ?>
			 <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="ribbon"><span>' . esc_html__( 'Sale!', 'truvatour' ) . '</span></div>', $post, $product ); ?>
            <?php endif; ?>
        	<div class="entry">            	 
                <?php
				if ( has_post_thumbnail() ) {
				$attachment_count = count( $product->get_gallery_attachment_ids() );
				$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image            = truvatour_post_thumb( 1000, 550, false );
				echo apply_filters(
					'woocommerce_single_product_image_html',
					sprintf(
						'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
						esc_url( $props['url'] ),
						esc_attr( $props['caption'] ),
						$gallery,
						$image
					),
					$post->ID
				);
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" class="img-responsive" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'truvatour' ) ), $post->ID );
			}
				?>
                <div class="magnifier">
                	<?php
                    $map_details = get_post_meta($post->ID, 'product_map', true);
					if($map_details != ''): ?>
                    <div class="magni-desc">
                        <a href="#mapcontent"><i class="fa fa-map-marker"></i><?php echo esc_html__('View Full Map', 'truvatour'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- end magnifier -->                
            </div>
            <?php endif; ?>
        </div>
    <?php
	
}

function truvatour_show_product_description_end(){
	?>
    </div>
    <?php
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'truvatour_template_single_title', 5 );

function truvatour_template_single_title(){
	global $post;
	global $product;
	?>
    <?php if(get_post_meta($post->ID, 'product_country', true) != ''): ?>
    	<span class="cruise-span"><?php echo esc_html__('From ', 'truvatour'); ?><span class="product-country"><?php echo get_post_meta($post->ID, 'product_country', true); ?></span></span>
    <?php endif; ?>    
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
    <!-- end rating -->
    <h4><?php the_title(); ?></h4>
    <?php
	$terms = get_the_terms( $post->ID, 'product_cat' );
	if($terms): ?>
    <ul class="list-inline">
	<?php
	foreach ($terms as $term) { ?>
		<li class="small"><a href="<?php echo esc_url( get_term_link( $term->slug, 'product_cat' ) ); ?>"><?php echo esc_html($term->name); ?></a></li>
	<?php	
	}
	?>
    </ul>
	<?php
	endif;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'truvatour_output_product_data_map', 70 );
add_action( 'woocommerce_single_product_summary', 'truvatour_output_product_data_tabs', 60 );

function truvatour_output_product_data_map(){
	global $post;
	global $product;
	if(get_post_meta($post->ID, 'product_map', true) != ''):
	?>
    <div class="row" id="mapcontent">
        <div class="col-md-12">
            <?php echo do_shortcode(wp_kses_post(get_post_meta($post->ID, 'product_map', true))); ?>
        </div>
    </div>
    <?php
	endif;
}

function truvatour_output_product_data_tabs(){
	wc_get_template( 'single-product/tabs/tabs.php' );
}

add_filter( 'woocommerce_output_related_products_args', 'truvatour_related_products_args' );
function truvatour_related_products_args( $args ) {
	$args['posts_per_page'] = (function_exists('ot_get_option'))? ot_get_option( 'related_product', 3 ) : 3; // 4 related products
    $args['columns'] = (function_exists('ot_get_option'))? ot_get_option( 'related_product_column', 3 ) : 3; // arranged in 2 columns
    return $args;
}

add_action( 'woocommerce_single_product_summary_sidebar', 'truvatour_template_sidebar_booking', 5 );

function truvatour_template_sidebar_booking(){
	global $post;
	global $product;
	?>
    <div class="widget clearfix">
        <div class="widget-title">
        	<?php $sidebar_widget_text_title = (function_exists('ot_get_option'))? ot_get_option('sidebar_widget_text_title', 'Book Now') : esc_html__('Book Now', 'truvatour'); ?>
            <h4><?php echo esc_html($sidebar_widget_text_title); ?></h4>
            <hr>
        </div>
        <div class="search-top clearfix"> 
        	<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>  
        </div><!-- end search-top -->
    </div>
    <?php
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'truvatour_custom_cart_button_text' );
 
function truvatour_custom_cart_button_text() {
	
	$add_to_cart_button_text = (function_exists('ot_get_option'))? ot_get_option('add_to_cart_button_text', 'BOOK NOW') : esc_html__('BOOK NOW', 'truvatour');
	return $add_to_cart_button_text; 
}

add_action( 'woocommerce_before_add_to_cart_button', 'truvatour_add_text_before_quantity', 50 );

function truvatour_add_text_before_quantity(){
	global $post;
	global $product;
	$product_quantity_text = get_post_meta(get_the_ID(), 'product_quantity_text', true);
	if($product_quantity_text != ''):
	?>
    <p><?php echo esc_html($product_quantity_text); ?></p>
    <?php else: ?>
    <p><?php echo esc_html__('Quantity', 'truvatour'); ?></p>
    <?php
	endif;
}

/**
 * Initialize the product meta boxes. 
 */
add_action( 'admin_init', 'truvatour_custom_product_meta_boxes' );

function truvatour_custom_product_meta_boxes() {

  if((function_exists('ot_get_option'))):
  $my_meta_box_pro = array(
    'id'        => 'product_details_information',
    'title'     => esc_html__('Product Info', 'truvatour'),
    'desc'      => '',
    'pages'     => array( 'product' ),
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(
		array(
        'id'          => 'header_banner_type',
        'label'       => esc_html__('Product Header Style', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
			array(
            'value'       => 'default',
            'label'       => esc_html__( 'Default', 'truvatour' ),
          ),
          array(
            'value'       => 'featured_image',
            'label'       => esc_html__( 'Featured Image', 'truvatour' ),
          )
		)
      ),
	  array(
        'id'          => 'product_gallery_style',
        'label'       => esc_html__('Product Gallery Style', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
			array(
            'value'       => 'default',
            'label'       => esc_html__( 'Default', 'truvatour' ),
          ),
          array(
            'value'       => 'flex_slider',
            'label'       => esc_html__( 'Slider', 'truvatour' ),
          )
		)
      ),
		array(
        'id'          => 'product_quantity_text',
        'label'       => esc_html__('Product Quantity Text', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
		array(
        'id'          => 'product_country',
        'label'       => esc_html__('Product Country', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
	  array(
        'id'          => 'product_map',
        'label'       => esc_html__('Product Map Shortcode', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
	  array(
        'id'          => 'lists_first_title',
        'label'       => esc_html__('First Lists Title', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'text',
        'class'       => '',
		'condition'   => '',
        'choices'     => array()
      ),
	  array(
        'id'          => 'lists_first_info',
        'label'       => esc_html__( 'Product list 1 info', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'product_list_text',
            'label'       => esc_html__( 'Description', 'truvatour' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
		  array(
            'id'          => 'product_list_colored',
            'label'       => esc_html__( 'Color Text', 'truvatour' ),
            'desc'        => '',
            'std'         => 'off',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	  array(
        'id'          => 'lists_first_title2',
        'label'       => esc_html__('Second Lists Title 2', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'min_max_step' => '',
        'type'        => 'text',
        'class'       => '',
		'condition'   => '',
        'choices'     => array()
      ),
	  array(
        'id'          => 'lists_first_info2',
        'label'       => esc_html__( 'Product list 2 info', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'product_list_text2',
            'label'       => esc_html__( 'Description', 'truvatour' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
		  array(
            'id'          => 'product_list_colored2',
            'label'       => esc_html__( 'Color Text', 'truvatour' ),
            'desc'        => '',
            'std'         => 'off',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	),
  );
  
  ot_register_meta_box( $my_meta_box_pro );

  endif;
}

/*-----product info hook*/
add_action( 'woocommerce_single_product_summary_sidebar', 'truvatour_template_product_info', 10 );

function truvatour_template_product_info(){
	
	global $product;	
	?>
    <?php if(get_post_meta(get_the_ID(),'lists_first_title', true) != ''): ?>    
    <div class="widget clearfix">
    	
        <div class="widget-title">
            <h4><?php echo esc_html(get_post_meta(get_the_ID(),'lists_first_title', true)); ?></h4>
            <hr>
        </div>
        <?php endif; ?>
        <?php 
		$feature_info = get_post_meta( get_the_ID(), 'lists_first_info', true );
		if(!empty($feature_info)): ?>
        <div class="table-responsive">
            <table class="table table-striped car-table-wrapper">
                <tbody>                    
					<?php
                    foreach( $feature_info as $value ):
					$color_class = ($value['product_list_colored'] == 'on')? ' closed' : '';
                    ?>
                    <tr>
                        <td class="<?php echo esc_attr($color_class); ?>"><strong><?php echo esc_html($value['title']); ?></strong></td>
                        <td class="<?php echo esc_attr($color_class); ?>"><?php echo esc_html($value['product_list_text']); ?></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>                    
                </tbody>
            </table>
        </div><!-- end table-responsive -->        
    </div>
    <?php endif; ?>
    <?php if(get_post_meta(get_the_ID(),'lists_first_title2', true) != ''): ?>
    <div class="widget clearfix">    	
        <div class="widget-title">
            <h4><?php echo esc_html(get_post_meta(get_the_ID(),'lists_first_title2', true)); ?></h4>
            <hr>
        </div>
        <?php endif; ?>
        <?php 
		$feature_info2 = get_post_meta( get_the_ID(), 'lists_first_info2', true );
		if(!empty($feature_info2)): ?>
        <div class="table-responsive">
            <table class="table table-striped car-table-wrapper">
                <tbody>                   
					<?php
                    foreach( $feature_info2 as $value ):
					$color_class2 = ($value['product_list_colored2'] == 'on')? ' closed' : '';
                    ?>
                     <tr>
                        <td class="<?php echo esc_attr($color_class2); ?>"><strong><?php echo esc_html($value['title']); ?></strong></td>
                        <td class="<?php echo esc_attr($color_class2); ?>"><?php echo esc_html($value['product_list_text2']); ?></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>                    
                </tbody>
            </table>
        </div><!-- end table-responsive -->        
    </div>
    <?php endif; ?>
    <?php
}

// advanced search functionality
function truvatour_advanced_search_query($query) {

    if($query->is_search()) {
        // category terms search.
        if (isset($_GET['product_cat_select']) && !empty($_GET['product_cat_select'])) {
            $query->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array($_GET['product_cat_select']) )
            ));
        }    
    }
    return $query;
}
add_action('pre_get_posts', 'truvatour_advanced_search_query', 1000);

/**
 * Initialize the product meta boxes. 
 */
add_action( 'admin_init', 'truvatour_custom_product_meta_boxes_features' );

function truvatour_custom_product_meta_boxes_features() {

  if((function_exists('ot_get_option'))):
  $my_meta_box_pro_fea = array(
    'id'        => 'product_details_information_features',
    'title'     => esc_html__('Product Features', 'truvatour'),
    'desc'      => '',
    'pages'     => array( 'product' ),
    'context'   => 'normal',
    'priority'  => 'low',
    'fields'    => array(
		array(
        'id'          => 'tour_features',
        'label'       => esc_html__( 'Tour Features?', 'truvatour' ),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		array(
        'id'          => 'product_feature_airplane',
        'label'       => esc_html__('Airplane', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'product_feature_accommodation',
        'label'       => esc_html__('Accommodation', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'product_feature_walking',
        'label'       => esc_html__('Walking', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'product_feature_wildlife',
        'label'       => esc_html__('Wildlife', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'product_feature_watersport',
        'label'       => esc_html__('Water Sport', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'product_feature_meal',
        'label'       => esc_html__('Meal', 'truvatour' ),
        'desc'        => '',
        'std'         => 'no',
        'min_max_step' => '',
        'type'        => 'radio',
        'class'       => '',
		'condition'   => 'tour_features:not(off)',
        'choices'     => array(
			array(
				'value'       => 'yes',
				'label'       => esc_html__( 'Yes', 'truvatour' ),
				'src'         => ''
			  ),
			  array(
				'value'       => 'no',
				'label'       => esc_html__( 'No', 'truvatour' ),
				'src'         => ''
			  ),
		  )
      ),
	  array(
        'id'          => 'car_features',
        'label'       => esc_html__( 'Vehicle Features?', 'truvatour' ),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'car_features_speed',
        'label'       => esc_html__( 'Speed', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'car_features:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'car_features_fuel',
        'label'       => esc_html__( 'Fuel', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'car_features:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'car_features_model',
        'label'       => esc_html__( 'Model', 'truvatour' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'car_features:not(off)',
        'operator'    => 'and'
      ),
	),
  );
  
  ot_register_meta_box( $my_meta_box_pro_fea );

  endif;
}