<?php

if ( ! class_exists( 'TPLshortCode' ) ):

	/**
	 *
	 */
	class TPLshortCode {

		function __construct() {
			add_shortcode( 'tlpteam', array( $this, 'team_shortcode' ) );

		}

		function team_shortcode( $atts ) {

			global $TLPteam;
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
				$html  .= "<div class='container-fluid tlp-team' id='{$layoutID}' data-desktop='{$grid}'>";
				$html  .= $this->customStyle( $layoutID, $atts );
				$class = 'layout-' . $atts['layout'];
				$attr  = '';
				if ( $atts['layout'] == 'carousel' ) {
					$loop               = $atts['loop'] == 1 ? 1 : 0;
					$autoplay           = $atts['autoplay'] == 1 ? 1 : 0;
					$items           = isset($atts['col']) ? absint($atts['col']) : 3;
					$nav                = $atts['nav'] == 1 ? 1 : 0;
					$dots               = $atts['dots'] == 1 ? 1 : 0;
					$autoplayHoverPause = $atts['autoplayHoverPause'] == 1 ? 1 : 0;
					$autoHeight         = $atts['autoHeight'] == 1 ? 1 : 0;
					$lazyLoad           = $atts['lazyLoad'] == 1 ? 1 : 0;
					$rtl                = $atts['rtl'] == 1 ? 1 : 0;
					$attr               .= " data-owl-options='{\"items\": {$items},\"loop\": {$loop},\"autoplay\": {$autoplay}, \"nav\": {$nav}, \"dots\": {$dots}, \"autoplayHoverPause\": {$autoplayHoverPause}, \"autoHeight\": {$autoHeight}, \"lazyLoad\": {$lazyLoad}, \"rtl\": {$rtl} }'";
				}
				if ( $atts['layout'] == 'isotope' ) {
					$html  .= '<div class="button-group sort-by-button-group">
									<button data-sort-by="original-order" class="selected">Default</button>
									<button data-sort-by="name">Name</button>
									  <button data-sort-by="designation">Designation</button>
								  </div>';
					$class .= ' tlp-team-isotope';
				}


				$html .= "<div class='tlp-row {$class}' {$attr}>";
				while ( $teamQuery->have_posts() ) : $teamQuery->the_post();
					$pID         = get_the_ID();
					$title       = get_the_title();
					$pLink       = get_permalink();
					$short_bio   = get_post_meta( get_the_ID(), 'short_bio', true );
					$designation = get_post_meta( get_the_ID(), 'designation', true );

					if ( has_post_thumbnail() ) {
						$imgSrc = $TLPteam->getFeatureImageSrc( $pID, $fImgSize, $customImgSize );
					} else {
						$imgSrc = $TLPteam->assetsUrl . 'images/demo.jpg';
					}

					if ( $atts['col'] == 2 ) {
						$image_area   = "tlp-col-md-5 tlp-col-sm-6 tlp-col-xs-12 ";
						$content_area = "tlp-col-md-7 tlp-col-sm-6 tlp-col-xs-12 ";
					} else {
						$image_area   = "tlp-col-md-3 tlp-col-sm-6 tlp-col-xs-12 ";
						$content_area = "tlp-col-md-9 tlp-col-sm-6 tlp-col-xs-12 ";
					}
					if ( ! $atts['image'] ) {
						$content_area = "tlp-col-md-12";
						$imgSrc       = null;
					}

					$sLink = unserialize( get_post_meta( get_the_ID(), 'social', true ) );
					$html  .= "<div class='team-member tlp-col-md-{$grid} tlp-col-sm-{$grid} tlp-col-xs-12 tlp-equal-height'>";
					switch ( $atts['layout'] ) {
						case 1:
							$html .= $this->layoutOne( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink );
							break;

						case 2:
							$html .= $this->layoutTwo( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area );
							break;

						case 3:
							$html .= $this->layoutThree( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area );
							break;

						case 4:
							$html .= $this->layoutFour( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area );
							break;

						case 'isotope':
							$html .= $this->layoutIsotope( $title, $pLink, $imgSrc, $designation, $grid );
							break;

						case 'carousel':
							$html .= $this->layoutCarousel( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area );
							break;

						default:
							# code...
							break;
					}
					$html .= "</div>";

				endwhile;
				wp_reset_postdata();
				// end row
				$html .= '</div>';
				$html .= '</div>'; // end container
			} else {
				$html .= "<p>" . __( 'No member found', TLP_TEAM_SLUG ) . "</p>";
			}

			return $html;
		}

		function layoutOne( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
			}
			$html .= '<div class="tlp-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="name">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			if ( $designation ) {
				$html .= '<div class="designation">' . $designation . '</div>';
			}
			$html .= '</div>';
			$html .= '<div class="short-bio">';
			if ( $short_bio ) {
				$html .= '<p>' . $short_bio . '</p>';
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

		function layoutTwo( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				$html .= '<div class="' . $image_area . '">';
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
				$html .= '</div>';
			}

			$html .= '<div class="' . $content_area . '">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="tlp-title"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
							    	<p>' . $short_bio . '</p>
							    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';

			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutThree( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				$html .= '<div class="' . $image_area . ' round-img">';
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
				$html .= '</div>';
			}
			$html .= '<div class="' . $content_area . '">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="tlp-title"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
						    	<p>' . $short_bio . '</p>
						    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';

			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutFour( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				$html .= '<div class="round-img">';
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
				$html .= '</div>';
			}

			$html .= '<div class="tlp-team-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="tlp-title"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
						        <p>' . $short_bio . '</p>
						    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutCarousel( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				$html .= '<div class="round-img">';
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
				$html .= '</div>';
			}

			$html .= '<div class="tlp-team-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="tlp-title"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
						        <p>' . $short_bio . '</p>
						    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutIsotope( $title, $pLink, $imgSrc, $designation, $grid ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $imgSrc ) {
				if ( $settings['link_detail_page'] == 'no' ) {
					$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
				} else {
					$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				}
			}
			$html .= '<div class="tlp-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="name">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			if ( $designation ) {
				$html .= '<div class="designation">' . $designation . '</div>';
			}
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		private function customStyle( $layoutID, $atts ) {
			$style       = null;
			$name        = ! empty( $atts['name-color'] ) ? $atts['name-color'] : null;
			$designation = ! empty( $atts['designation-color'] ) ? $atts['designation-color'] : null;
			$sd          = ! empty( $atts['sd-color'] ) ? $atts['sd-color'] : null;
			if ( $name ) {
				$style .= "#{$layoutID} .single-team-area h3,
							#{$layoutID} .single-team-area h3 a{ color: {$name};}";
			}
			if ( $designation ) {
				$style .= "#{$layoutID} .single-team-area .designation{ color: {$designation};}";
			}
			if ( $sd ) {
				$style .= "#{$layoutID} .single-team-area .short-bio{ color: {$sd};}";
			}

			if ( ! empty( $style ) ) {
				$style = "<style>{$style}</style>";
			}

			return $style;

		}


	}

endif;
