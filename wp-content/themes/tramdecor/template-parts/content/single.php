<?php setPostViews(get_the_ID()); ?>
<div class="left_ndetail_page">

    <div class="tab_head_nd">
        <?php foreach (get_the_tags() as $tag): ?>
            <span class="btn_a_color font_open"><?php echo $tag->name; ?></span>
        <?php endforeach; ?>
    </div>
    <h2 class="font_open title_new_detail"><?php the_title() ?></h2>
    <div class="date_new font_open">
        <span><i class="fa fa-calendar"></i> <?php the_date('d/m/Y') ?> </span> |
        <span> <i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()) ?></span>
    </div>
    <div class="content_new_detail font_open">
        <?php $format = get_post_format();
            if ($format == 'video') {
                $post_embed_video = rwmb_meta('themepixels_post_video_embed_url', 'type=oembed', get_the_ID() );
                $post_self_hosted_video = rwmb_meta( 'themepixels_post_self_hosted_video', 'type=file_input', get_the_ID() );
                if ( has_post_thumbnail() ) {
                    $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                }

                if( rwmb_meta( 'themepixels_video_type', '', get_the_ID() ) == 'embed' ) {
                    if( $post_embed_video != '' ) { ?>
                        <div class="post-video-wrapper responsive-video-wrapper clearfix"><?php echo wp_oembed_get( $post_embed_video ); ?></div>
                    <?php }
                } elseif( rwmb_meta( 'themepixels_video_type', '', get_the_ID() ) == 'selfhosted' ) {
                    if( $post_self_hosted_video != '' ) { ?>
                        <div class="post-video-wrapper clearfix">
                            <?php echo do_shortcode( '[video src="'. esc_url( $post_self_hosted_video ) .'" poster="'. esc_url( $img_src[0] ) .'"][/video]' ); ?>
                        </div>
                    <?php }
                }
            } else {
        ?>
        <img class="img-responsive" src="<?php the_post_thumbnail_url() ?>"> <br>
        <?php } ?>
        <?php the_content() ?>
    </div>
</div>
<div class="blog_link_page">
    <?php social_share(); ?>
</div>
<?php get_template_part( 'template-parts/content/related-posts' );?>
<?php get_template_part( 'template-parts/content/post-navigation' );?>
