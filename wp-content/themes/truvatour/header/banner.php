<?php
	$title = '';
	$subtitle = '';	
	
	if(is_single()){
		$title = (function_exists('ot_get_option'))? ot_get_option('blog_title', 'TruvaTour Blog') : '';
		$subtitle = (function_exists('ot_get_option'))? ot_get_option('blog_subtitle', 'TruvaTour blog subtitle goes here') : '';
	}
	elseif( is_home() ){		
		$title = (function_exists('ot_get_option'))? ot_get_option('blog_title', 'TruvaTour Blog') : '';
		$subtitle = (function_exists('ot_get_option'))? ot_get_option('blog_subtitle', 'TruvaTour blog subtitle goes here') : '';
	}
	elseif ( is_category() ){
		$title = esc_html__( 'Category Archives: ', 'truvatour' ).single_cat_title( '', false );
		if ( category_description() ) :
			$subtitle = category_description();
		endif;

	}
	elseif(is_search()){
		$title = esc_html__('Search Result', 'truvatour');
		$subtitle = esc_html__( 'This is a Search Results Page for: '. get_search_query(), 'truvatour' );
	}
	elseif ( is_author() ){
		$title = esc_html__( 'Author Archives: ', 'truvatour' ).'' . get_the_author() . '';
		if ( category_description() ) :
			$subtitle = category_description();
		endif;
	} 
	elseif( is_tag() ) {
		$title = esc_html__( 'Tag Archives: ', 'truvatour' ).single_tag_title( '', false );
		if ( tag_description() ) :
			$subtitle = tag_description();
		endif;
	}
	elseif ( is_archive() ){	
			
		if ( is_day() ) :
			$title =  esc_html__( 'Daily Archives: ', 'truvatour' ).'' . get_the_date() . '';
		elseif ( is_month() ) :
			$title = esc_html__( 'Monthly Archives: ', 'truvatour' ). '' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'truvatour' ) ) . '' ;
		elseif ( is_year() ) :
			$title = esc_html__( 'Yearly Archives: ', 'truvatour' ).'' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'truvatour' ) ) . '' ;
		else :
			$title = esc_html__( 'Archives', 'truvatour' );
		endif;
	} 	
	 elseif(is_404()){
		$title = esc_html__('Page Not Found', 'truvatour');
		$subtitle = esc_html__( 'Sorry page not found...', 'truvatour');
	}
	elseif( is_page() ){
		$title = get_the_title();
		$custom_title = get_post_meta( get_the_ID(), 'custom_title', true );
		if( $custom_title == 'on' ){
			$alt_title = get_post_meta( get_the_ID(), 'title', true );
			$title = ( $alt_title != '' )? $alt_title : $title;
	
			$alt_subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
			$subtitle = ( $alt_subtitle != '' )? $alt_subtitle : $subtitle;
		}
	}
	else {
		$title = get_the_title();
	}
	
	if ( class_exists( 'woocommerce' ) ){
		if( is_product() ){
			$title = (function_exists('ot_get_option'))? ot_get_option('shop_single_title', 'Single Product') : '';
			$subtitle = (function_exists('ot_get_option'))? ot_get_option('shop_single_subtitle', 'TruvaTour shop single subtitle goes here') : '';
		}
		elseif(is_shop()){
			$title = (function_exists('ot_get_option'))? ot_get_option('shop_page_title', 'TruvaTour Shop') : '';
			$subtitle = (function_exists('ot_get_option'))? ot_get_option('shop_subtitle', 'TruvaTour shop subtitle goes here') : '';
		}
		elseif( is_shop() || is_cart() || is_checkout() ){
			$title = get_the_title();
			$subtitle = (function_exists('ot_get_option'))? ot_get_option('shop_subtitle', 'TruvaTour shop subtitle goes here') : '';
		}
	}

?>
<?php
$header_banner_type = get_post_meta( get_the_ID(), 'header_banner_type', true );
$header_custom_shortcode = get_post_meta( get_the_ID(), 'header_custom_shortcode', true );

if($header_banner_type == 'bg_shortcode' && $header_custom_shortcode != ''): ?>
<section class="shortcode-section clearfix">
<?php echo do_shortcode(wp_kses_post($header_custom_shortcode)); ?>
</section>
<?php elseif($header_banner_type == 'featured_image' && has_post_thumbnail()): 
$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'full' );
?>
<section class="section parallax transparent-title transparent-parallax-title" data-stellar-background-ratio="0.7" data-backgroundimage="<?php echo esc_attr($fullsize[0]); ?>">
</section>
<section class="section lb page-title1 little-pad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-big-title clearfix">
                    <div class="pull-left">
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo wp_kses($subtitle, array('p'=>array())); ?></p>
                    </div>                    
                    <?php 
					$show_breadcrumbs =  (function_exists('ot_get_option'))? ot_get_option('show_breadcrumbs', 'on') : 'on';
					if($show_breadcrumbs == 'on'): ?>
                    	<div class="pull-right hidden-xs">
                        	<?php truvatour_breadcrumbs(); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="section lb page-title1 little-pad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-big-title clearfix">
                    <div class="pull-left">
                    	<?php 
						$margin_class = '';
						if($title != '' && $subtitle != ''):
						$margin_class = ' top-margin-20';
                        endif; ?>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo wp_kses($subtitle, array('p'=>array())); ?></p>
                    </div>                    
                    <?php 
					$show_breadcrumbs =  (function_exists('ot_get_option'))? ot_get_option('show_breadcrumbs', 'on') : 'on';
					if($show_breadcrumbs == 'on'): ?>
                    	<div class="pull-right hidden-xs<?php echo esc_attr($margin_class); ?>">
                        	<?php truvatour_breadcrumbs(); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>