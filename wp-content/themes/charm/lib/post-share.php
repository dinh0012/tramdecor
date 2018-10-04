<?php
/**
 * Post Share
 *
 * @package Smart Blog
 * @since 1.0
 */

if ( ! function_exists( 'social_share' ) ) {
	function social_share() {
        $new_window = ' target="_blank"';
        $social_sharing_links = [
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'linkedin' => 'linkedin',
            'pinterest' => 'pinterest',
            'googleplus' => 'googleplus',
        ];
        global $post;
		$link = get_permalink($post->ID);
		$title = the_title_attribute( 'echo=0' );
		$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
//print_r($social_sharing_links);
		$output = '';
        foreach ($social_sharing_links as $key => $value) {

            if ($key == 'facebook' && $value) {
                $output .= '<div class="item_bl"><a href="http://www.facebook.com/sharer.php?u=' . urlencode($link) .
                    '" data-toggle="tooltip" data-placement="top" 
                    title="' . __('Share on Facebook', 'themepixels') . '" ' . $new_window . '>
                    <i class="fa fa-facebook"></i></a></div>';
            }

            if ($key == 'twitter' && $value) {
                $output .= '<div class="item_bl">
                     <a href="https://twitter.com/share?url=' . urlencode($link) . '&text=' . esc_attr($title) .
                    '"data-toggle="tooltip" data-placement="top" 
                    title="' . __('Share on Twitter', 'themepixels') . '" ' . $new_window . '>
                    <i class="fa fa-twitter"></i></a></div>';
            }
            if ($key == 'linkedin' && $value) {
                $output .= '<div class="item_bl"><a href="http://www.linkedin.com/shareArticle?url=' . urlencode($link) . '&title=' . esc_attr($title) .
                    '" data-toggle="tooltip" data-placement="top" 
                    title="' . __('Share on Linkedin', 'themepixels') . '" ' . $new_window . '>
                    <i class="fa fa-linkedin"></i></a></div>';
            }

            if ($key == 'pinterest' && $value) {
                $output .= '<div class="item_bl">
                <a href="https://pinterest.com/pin/create/bookmarklet/?media=' . $img . '&url=' . urlencode($link) . '&is_video=false&description=' . esc_attr($title) .
                    '" data-toggle="tooltip" data-placement="top" title="' . __('Share on Pinterest', 'themepixels') . '" ' . $new_window . '>
                    <i class="fa fa-pinterest"></i></a></div>';
            }

            if ($key == 'googleplus' && $value) {
                $output .= '<div class="item_bl"><a href="https://plus.google.com/share?url=' . urlencode($link) .
                    '" data-toggle="tooltip" data-placement="top" 
                    title="' . __('Share on Google Plus', 'themepixels') . '" ' . $new_window . '>
                    <i class="fa fa-google-plus"></i></a></div>';
            }

        }

        echo $output;

	}
}