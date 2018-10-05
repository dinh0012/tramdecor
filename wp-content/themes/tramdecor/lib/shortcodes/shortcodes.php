<?php

function team_shortcode( $atts ) {

    global $TLPteam;
    if (!$TLPteam) {
        return;
    }
    $atts          = shortcode_atts( array(
        'layout'             => 1,
        'member'             => null,
        'image'              => 'true',
        'col'                => 3,
        'orderby'            => 'date',
        'order'              => 'DESC',
        'name-color'         => null,
        'designation-color'  => null,
        'sd-color'           => null,
        'loop'               => 1,
        'autoplay'           => 1,
        'autoplayHoverPause' => 1,
        'nav'                => 1,
        'dots'               => 1,
        'autoHeight'         => 1,
        'lazyLoad'           => 1,
        'rtl'                => 0,
    ), $atts, 'tlpteam' );
    $atts['image'] = 'true' === $atts['image'];

    if ( ! in_array( $atts['col'], array_keys( $TLPteam->scColumns() ) ) ) {
        $atts['col'] = 3;
    }
    if ( ! in_array( $atts['layout'], array_keys( $TLPteam->scLayouts() ) ) ) {
        $atts['layout'] = 1;
    }
    $posts_per_page = $atts['member'] ? absint( $atts['member'] ) : '-1';
    $html           = null;

    $args = array(
        'post_type'      => 'team',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby'        => $atts['orderby'],
        'order'          => $atts['order']
    );
    if ( is_user_logged_in() && is_super_admin() ) {
        $args['post_status'] = array( 'publish', 'private' );
    }
    $settings      = get_option( $TLPteam->options['settings'] );
    $fImgSize      = ! empty( $settings['feature_img_size'] ) ? $settings['feature_img_size'] : $TLPteam->options['feature_img_size'];
    $customImgSize = ! empty( $settings['rt_custom_img_size'] ) ? $settings['rt_custom_img_size'] : array();

    $teamQuery = new WP_Query( $args );
    $layoutID  = "tlp-team-" . mt_rand();
    $grid      = $atts['col'] == 5 ? '24' : 12 / $atts['col'];
    if ( $teamQuery->have_posts() ) {
        $html  .= "<div class='' id='{$layoutID}' data-desktop='{$grid}'>";
        $html .= "<section class='team_page'>";
        $html .= "<div class='container'>";
        $html .= "<div class='row'>";
        $html .= "<div class='section_theme_page'>";
        while ( $teamQuery->have_posts() ) : $teamQuery->the_post();
            $pID         = get_the_ID();
            $title       = get_the_title();
            $pLink       = get_permalink();
            $telephone   = get_post_meta( get_the_ID(), 'telephone', true );
            $designation = get_post_meta( get_the_ID(), 'designation', true );

            if ( has_post_thumbnail() ) {
                $imgSrc = $TLPteam->getFeatureImageSrc( $pID, $fImgSize, $customImgSize );
            } else {
                $imgSrc = $TLPteam->assetsUrl . 'images/demo.jpg';
            }
            $sLink = unserialize( get_post_meta( get_the_ID(), 'social', true ) );
            $html .= "<div class='cel_md_3 cod_sm_4 cod_tm_6 cod_wl_12'>";
            $html .= layoutTeam( $title, $pLink, $imgSrc, $designation, $telephone, $sLink );
            $html .= "</div>";

        endwhile;
        wp_reset_postdata();
        // end row
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>'; // end container
    } else {
        $html .= "<p>" . __( 'No member found', TLP_TEAM_SLUG ) . "</p>";
    }

    return $html;
}
add_shortcode( 'charmteam', 'team_shortcode' );


function layoutTeam( $title, $pLink, $imgSrc, $designation, $telephone, $sLink ) {
    global $TLPteam;
    $settings = get_option( $TLPteam->options['settings'] );
    $html     = null;
    $html     .= '<div class="item_team">';
    $html     .= '<div class="border_img"><div class="border_eff"></div></div>';
    if ( $imgSrc ) {
        if ( $settings['link_detail_page'] == 'no' ) {
            $html .= '<div class="img_t"><img class="img-responsive" src="'. $imgSrc . '" alt="' . $title . '"></div>';
        } else {
            $html .= '<a title="' . $title . '" href="' . $pLink . '"><div class="img_t"><img class="img-responsive" src="'. $imgSrc . '" alt="' . $title . '"></div></a>';
        }
    }
    $html .= '<div class="content_t">';
    if ( $settings['link_detail_page'] == 'no' ) {
        $html .= '<h3 class="h3_title_blog font_gothic_bold">' . $title . '</h3>';
    } else {
        $html .= '<a title="' . $title . '" href="' . $pLink . '"><h3 class="h3_title_blog font_gothic_bold">' . $title . '</h3></a>';
    }
    if ( $designation ) {
        $html .= '<span class="font_gothic_r">' . $designation . '</span>';
    }
    if ( $telephone ) {
        $html .= '<div class="phone_team font_gothic_r">' . $telephone . '</div>';
    }
    $html .= '</div>';

    $html .= '<div class="tpl-social">';
    if ( $sLink ) {
        foreach ( $sLink as $id => $link ) {
            $html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
        }
    }
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

function contact_us_shortcode( $atts ) {
    $title = $atts['title'];
    $des = $atts['description'];
    $labelBtn = $atts['labelBtn'] ?: 'Contact us';
    $linkContact = $atts['linkcontact'] ;
    $bg = $atts['background'] ?: get_template_directory_uri() . '/img/bg_f.png';
    $html = '';
    $html .= '<div class="parallax_bg" style="background-image: url(' . $bg . ');">';
    $html .= '<div class="container">';
    $html .= '<div class="row">';
    $html .= '<div class="col-md-1 col-sm-1">';
    $html .= '<div class="parallax_icon">';
    $html .= '<i class="fa fa-envelope" aria-hidden="true"></i>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="col-md-7 col-sm-7">';
    $html .= '<div class="parallax_text">';
    $html .= '<h5 class="font_gothic_bold">' . $title .'</h5>';
    $html .= '<p class="font_gothic_r">' . $des .'</p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="col-md-4 col-sm-4">';
    $html .= '<center>';
    $html .= '<a href="' . $linkContact . '" class="btn_para font_gothic_bold">' . $labelBtn .'</a>';
    $html .= '</center>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}
add_shortcode( 'contact_us', 'contact_us_shortcode' );

function charm_video_shortcode( $atts ) {
    $title = $atts['title'];
    $des = $atts['description'];
    $urlVideo = $atts['url'];
    $direction = $atts['floatvideo'] ?: 'left';
    $classVideoService = $direction != 'left' ? 'video_page_service' : '';
    $classColumnVideo = $direction == 'left' ? 'col-md-6' : 'col-md-5';
    $classColumnText = $direction == 'left' ? 'col-md-5' : 'col-md-6';
    $video = '<div class="video_l">';
    $video .= '<div class="iframe_vd">';
    $video .= '<div class="embed-responsive embed-responsive-16by9">';
    $video .= '<iframe class="embed-responsive-item" src="' . $urlVideo . '" ></iframe>';
    $video .= '</div>';
    $video .= '</div>';
    $video .= '</div>';

    $text = '<div class="video_r">';
    $text .= '<h3 class="font_gothic_bold">' . $title . '</h3>';
    $text .= '<div class="content_vd font_gothic_r">' . $des;
    $text .= '</div>';
    $text .= '</div>';

    $html = '';
    $html .= '<div class="charm3_video ' . $classVideoService . '">';
    $html .= '<div class="container">';
    $html .= '<div class="video_page">';
    $html .= '<div class="row">';
    $html .= '<div class="' . $classColumnVideo . '">';
    if ($direction == 'left') {
        $html .= $video;
    } else {
        $html .= $text;
    }
    $html .= '</div>';
    $html .= '<div class="' . $classColumnText . ' col-md-offset-1 col-sm-offset-0 col-xs-offset-0">';
    if ($direction != 'left') {
        $html .= $video;
    } else {
        $html .= $text;
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'charm_video', 'charm_video_shortcode' );

function service_home_shortcode( $atts ) {
    $title = $atts['title'];
    $title1 = $atts['title_service1'];
    $title2 = $atts['title_service2'];
    $title3 = $atts['title_service3'];
    $title4 = $atts['title_service4'];
    $des1 = $atts['des_service1'];
    $des2 = $atts['des_service2'];
    $des3 = $atts['des_service3'];
    $des4 = $atts['des_service4'];

    $icon1 = $atts['icon1'];
    $icon2 = $atts['icon2'];
    $icon3 = $atts['icon3'];
    $icon4 = $atts['icon4'];

    $image = $atts['image'] ? : get_template_directory_uri() . '/img/CharmOutsource.png';

    $html = '';
    $html .= '<div class="charm3_service">';
    $html .= '<div class="container">';
    $html .= '<h3 class="h3_title_id">' . $title . '</h3>';
    $html .= '<div class="col-md-7">';
    $html .= '<div class="service_item">';
    $html .= '<div class="cel_md_6 cel_md_hv">';
    $html .= '<div class="i_it">';
    $html .= '<div class="it_icon"><i class="fa ' . $icon1 . '" aria-hidden="true"></i></div>';
    $html .= '<div class="it_border"></div>';
    $html .= '<div class="it_number">01</div>';
    $html .= '</div>';
    $html .= '<div class="i_h3">' . $title1;
    $html .= '</div>';
    $html .= '<div class="i_content">' . $des1;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="cel_md_6 cel_md_hv">';
    $html .= '<div class="i_it">';
    $html .= '<div class="it_icon"><i class="fa ' . $icon2 . '" aria-hidden="true"></i></div>';
    $html .= '<div class="it_border"></div>';
    $html .= '<div class="it_number">02</div>';
    $html .= '</div>';
    $html .= '<div class="i_h3">' . $title2;
    $html .= '</div>';
    $html .= '<div class="i_content">' . $des2;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="cel_md_6 cel_md_hv">';
    $html .= '<div class="i_it">';
    $html .= '<div class="it_icon"><i class="fa ' . $icon3 . '" aria-hidden="true"></i></div>';
    $html .= '<div class="it_border"></div>';
    $html .= '<div class="it_number">03</div>';
    $html .= '</div>';
    $html .= '<div class="i_h3">' . $title3;
    $html .= '</div>';
    $html .= '<div class="i_content">' . $des3;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="cel_md_6 cel_md_hv">';
    $html .= '<div class="i_it">';
    $html .= '<div class="it_icon"><i class="fa ' . $icon4 . '" aria-hidden="true"></i></div>';
    $html .= '<div class="it_border"></div>';
    $html .= '<div class="it_number">04</div>';
    $html .= '</div>';
    $html .= '<div class="i_h3">' . $title4;
    $html .= '</div>';
    $html .= '<div class="i_content">' . $des4;
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="col-md-5">';
    $html .= '<div class="service_img">';
    $html .= '<img class="img-responsive" src="' . $image .'">';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'service_home_page', 'service_home_shortcode' );

function testimonial_shortcode( $atts ) {
    $num = $atts['number'];
    $title = $atts['title'] ? : 'See The Testimonials';
    $testimonials = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $num ) );

    $html = '';
    $html .= '<div class="charm3_testimonials">';
    $html .= '<div class="container">';
    $html .= '<h3 class="h3_title_id">' . $title . '</h3>';
    $html .= '<div class="row">';
    $html .= '<div class="col-md-8 col-md-offset-2 col-xs-12">';
    $html .= '<div class="testimonials_sli">';
    $html .= '<div class="slider-for">';

    if( $testimonials->have_posts() ) : while( $testimonials->have_posts() ) : $testimonials->the_post();
        $html .= '<div>';
        $html .= '<div class="img_ts">';
        $html .= '<img class="img-responsive" src="' . get_the_post_thumbnail_url() . '" alt=""/>';
        $html .= '</div>';
        $html .= '</div>';
    endwhile; endif;
    $html .= '</div>';
    $html .= '<div class="slider-nav"> ';
    if( $testimonials->have_posts() ) : while( $testimonials->have_posts() ) : $testimonials->the_post();
        $html .= '<div>';
        $html .= '<p class="font_gothic_r">' . get_the_content() . '</p>';
        $html .= '<h5 class="font_gothic_r">' . get_the_title() . '</h5>';
        $html .= '</div>';
    endwhile; endif;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}
add_shortcode( 'testimonial', 'testimonial_shortcode' );

function package_shortcode( $atts ) {
    $num = $atts['number'];
    $title = $atts['title'];
    $des = $atts['description'];
    $location = $atts['location'] ?: 'home';
    $classService = $location == 'service' ? 'head_page_service' : '';
    $query = new WP_Query( array( 'post_type' => 'charm_package', 'posts_per_page' => $num, 'meta_query' => array(
        array(
            'key'     => '_location',
            'value'   => $location,
            'compare' => 'LIKE',
        ),
    ), ) );

    $html = '';
    $html .= '<div class="charm3_head ' . $classService . '">';
    $html .= '<div class="container">';
    if ($title && $des) {
        $html .= '<h3 class="h3_title_id">' . $title . '</h3>';
        $html .= '<div class="span_p font_gothic_r">' . $des . '</div>';
    }

    $html .= '<div class="row">';
    if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
        $iconClass = get_post_meta(get_the_ID(), '_icon_package', true);
        $html .= '<div class="col-md-4">';
        $html .= '<div class="item_h">';
        $html .= '<h3><a href="" class="font_gothic_bold">' . get_the_title() . '</a></h3>';
        $html .= '<div class="img_h">';
        $html .= '<a href="' . get_the_permalink() . '" style="background-image:url(' . get_the_post_thumbnail_url() . ')"></a>';
        $html .= '</div>';
        $html .= '<div class="content_h">';
        $html .= '<div class="icon_h">';
        $html .= '<i class="fa ' . $iconClass . '" aria-hidden="true"></i>';
        $html .= '</div>';
        $html .= '<div class="text_h font_gothic_r">';
        $html .= get_the_content();
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
    endwhile; endif;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'package', 'package_shortcode' );

function service_shortcode( $atts ) {
    $num = $atts['number'];

    $query = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => $num ) );

    $html = '';
    $html .= '<div class="charm3_service service_page_theme">';
    $html .= '<div class="container">';
    $html .= '<div class="row">';
    $html .= '<div class="col-md-12">';
    $html .= '<div class="service_item">';
    $i = 1;
    if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
        $html .= '<div class="cel_md_3 cod_sm_4 cod_xs_6 cod_wl_12 cel_md_hv">';
        $html .= '<div class="i_it">';
        $html .= '<div class="it_icon" style="background:url(' . get_the_post_thumbnail_url() . ');background-size:cover;border: 2px solid #d90e0f;    background-position: center;"></div>';
        $html .= '<div class="it_border">';
        $html .= '</div>';
        $html .= '<div class="it_number">' . $i . ' </div>';
        $html .= '</div>';
        $html .= '<div class="i_h3">' . get_the_title() . '</div>';
        $html .= '<div class="i_content">' . get_the_content() . '</div>';
        $html .= '</div>';
        $i++;
    endwhile; endif;

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'service', 'service_shortcode' );

function how_we_work_shortcode( $atts ) {
    $title = $atts['title'];
    $des = $atts['description'];

    $title1 = $atts['title1'];
    $title2 = $atts['title2'];
    $title3 = $atts['title3'];

    $items1 = explode('/#', $atts['items1']);
    $items2 = explode('/#', $atts['items2']);
    $items3 = explode('/#', $atts['items3']);

    $money1 = $atts['money1'];
    $money2 = $atts['money2'];
    $money3 = $atts['money3'];

    $time1 = $atts['time1'];
    $time2 = $atts['time2'];
    $time3 = $atts['time3'];

    $icon1 = $atts['icon1'];
    $icon2 = $atts['icon2'];
    $icon3 = $atts['icon3'];


    $html = '';
    $html .= '<div class="charm3_head head_page_service">';
    $html .= '<div class="container">';
    $html .= '<h3 class="h3_title_id">' . $title . '</h3>';
    $html .= '<div class="span_p font_gothic_r">' . $des . '</div>';
    $html .= '<div class="contai_hw">';
    $html .= '<div class="row">';

    //item 1
    $html .= '<div class="col-md-4 col-sm-6">';
    $html .= '<div class="item_hw">';
    $html .= '<div class="ihead">';
    $html .= '<div class="iicon">';
    $html .= '<span><i class="fa ' . $icon1 .'" aria-hidden="true"></i></span>';
    $html .= '</div>';
    $html .= '<div class="h4_title font_gothic_bold">' . $title1 . ' </div>';
    $html .= '</div>';
    $html .= '<div class="icontent">';
    $html .= '<ul>';
    foreach ($items1 as $item) {
        $html .= '<li>' . $item;
        $html .= '</li>';
    }
    $html .= '</ul>';
    $html .= '<div class="imoney font_gothic_bold">' .$money1;
    $html .= '/<span>' . $time1 . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    //item 2
    $html .= '<div class="col-md-4 col-sm-6">';
    $html .= '<div class="item_hw active_item">';
    $html .= '<div class="ihead">';
    $html .= '<div class="iicon">';
    $html .= '<span><i class="fa ' . $icon2 .'" aria-hidden="true"></i></span>';
    $html .= '</div>';
    $html .= '<div class="h4_title font_gothic_bold">' . $title2 . ' </div>';
    $html .= '</div>';
    $html .= '<div class="icontent">';
    $html .= '<ul>';
    foreach ($items2 as $item) {
        $html .= '<li>' . $item;
        $html .= '</li>';
    }
    $html .= '</ul>';
    $html .= '<div class="imoney font_gothic_bold">' .$money2;
    $html .= '/<span>' . $time2 . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    //item 3
    $html .= '<div class="col-md-4 col-sm-6">';
    $html .= '<div class="item_hw">';
    $html .= '<div class="ihead">';
    $html .= '<div class="iicon">';
    $html .= '<span><i class="fa ' . $icon3 .'" aria-hidden="true"></i></span>';
    $html .= '</div>';
    $html .= '<div class="h4_title font_gothic_bold">' . $title3 . ' </div>';
    $html .= '</div>';
    $html .= '<div class="icontent">';
    $html .= '<ul>';
    foreach ($items3 as $item) {
        $html .= '<li>' . $item;
        $html .= '</li>';
    }
    $html .= '</ul>';
    $html .= '<div class="imoney font_gothic_bold">' .$money3;
    $html .= '/<span>' . $time3 . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'how_we_work', 'how_we_work_shortcode' );

function blog_shortcode( $atts ) {
    $num = $atts['number'];
    global $paged;

    $query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $num,  'paged' => $paged) );
    $totalPage = $query->max_num_pages;
    $html = '';
    $html .= '<div class="left_new_page">';
    $html .= '<div class="row">';
    if(empty($paged)) $paged = 1;

    if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
        $html .= '<div class="col-md-12">';
        $html .= '<div class="item_n">';
        $format = get_post_format();
        if ($format == 'video') {
            $post_embed_video = rwmb_meta('themepixels_post_video_embed_url', 'type=oembed', get_the_ID() );
            $post_self_hosted_video = rwmb_meta( 'themepixels_post_self_hosted_video', 'type=file_input', get_the_ID() );
            if ( has_post_thumbnail() ) {
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
            }
            if (rwmb_meta('themepixels_video_type', '', get_the_ID()) == 'embed') {
                if ($post_embed_video != '') {
                    $html .= '<div class="post-video-wrapper responsive-video-wrapper clearfix">'. wp_oembed_get( $post_embed_video ) .'</div>';
                }
            } elseif (rwmb_meta('themepixels_video_type', '', get_the_ID()) == 'selfhosted') {
                if ($post_self_hosted_video != '') {
                    $html .= '<div class="post-video-wrapper clearfix">';
                    $html .= do_shortcode('[video src="' . esc_url($post_self_hosted_video) . '" poster="' . esc_url($img_src[0]) . '"][/video]');
                    $html .= '</div>';
                }
            }
        } else {
            $html .= '<a href="' . get_the_permalink() . '" class="img_n">';
            $html .= '<img src="' . get_the_post_thumbnail_url() . '" alt="" class="img-responsive">';
            $html .= '</a>';
        }

        $html .= '<div class="content_n">';
        $html .= '<h3 class="font_open">';
        $html .= '<a class="h3_title_blog font_gothic_bold" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
        $html .= '</h3>';
        $html .= '<div class="date_new font_open">';
        $html .= '<span> <i class="fa fa-eye" aria-hidden="true"></i> 
            ' . getPostViews(get_the_ID()) . '</span><span>  | ';

        $html .= '<span><i class="fa fa-calendar"></i> ' . get_the_date('d/m/Y') . '</span> |';
        $html .= '<span> <i class="fa fa-user"></i> ' . get_the_author() . '</span>';
        $html .= '</div>';
        $html .= '<div class="span_c font_open">' . get_the_excerpt();
        $html .= '</div>';
        $html .= '<a href="' . get_the_permalink() . '" class="pull-right bnt_a_blog">Read More</a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
    endwhile; endif;
    if ($totalPage > 1) {
        $html .= '<div class="pagination-row">';
        $html .= ' <nav>';
        $html .= '<ul class="pagination">';
        if ($paged > 1) {
            $html .= '<li><a href="' . get_pagenum_link($paged - 1). '"><i class="fa fa-angle-double-left"></i></a></li>';
        }
        for ($i = 1; $i <= $totalPage; $i++) {
            $classActive = $i == $paged ? 'active' : '';
            $html .= '<li class="' . $classActive . '"><a href="' . get_pagenum_link($i). '">' . $i .'</a></li>';
        }
        if ($paged < $totalPage) {
            $html .= '<li><a href="' . get_pagenum_link($paged + 1).' "><i class="fa fa-angle-double-right"></i></a></li>';
        }

        $html .= '</ul></nav></div>';
    }


    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'blog', 'blog_shortcode' );

