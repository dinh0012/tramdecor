<?php
/**
 * Created by PhpStorm.
 * User: dinh0
 * Date: 10/8/2018
 * Time: 10:16 PM
 */

function teams_shortcode( $atts ) {
    $num = $atts['number'];
    $title = $atts['title'] ? : 'ĐỘI NGŨ SÁNG TẠO VÀ CHUYÊN NGHIỆP';
    $teams = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => $num ) );

    $html = '';
    $html .= '<div class="charm3_testimonials">';
    $html .= '<div class="container">';
    $html .= '<h3 class="h3_title_id">' . $title . '</h3>';
    $html .= '<div class="row">';
    $html .= '<div class="col-md-8 col-md-offset-2 col-xs-12">';
    $html .= '<div class="testimonials_sli">';
    $html .= '<div class="slider-for">';

    if( $teams->have_posts() ) : while( $teams->have_posts() ) : $teams->the_post();

    endwhile; endif;
    $html .= '</div>';
    $html .= '<div class="slider-nav"> ';
    if( $teams->have_posts() ) : while( $teams->have_posts() ) : $teams->the_post();
        $html .= '<div>';
        $html .= '<div class="img_ts">';
        $html .= '<img class="img-responsive" src="' . get_the_post_thumbnail_url() . '" alt=""/>';
        $html .= '</div>';
        $html .= '</div>';
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
add_shortcode( 'teams', 'teams_shortcode' );