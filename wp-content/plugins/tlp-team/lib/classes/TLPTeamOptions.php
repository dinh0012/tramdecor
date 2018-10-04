<?php
if ( ! class_exists( 'TLPTeamOptions' ) ) :

	class TLPTeamOptions {
		function socialLink() {
			return array(
				'facebook'    => __( 'Facebook', TLP_TEAM_SLUG ),
				'twitter'     => __( 'Twitter', TLP_TEAM_SLUG ),
				'linkedin'    => __( 'LinkedIn', TLP_TEAM_SLUG ),
				'youtube'     => __( 'Youtube', TLP_TEAM_SLUG ),
				'vimeo'       => __( 'Vimeo', TLP_TEAM_SLUG ),
				'google-plus' => __( 'Google+', TLP_TEAM_SLUG ),
				'instagram'   => __( 'Instagram', TLP_TEAM_SLUG )
			);
		}

		function scColumns() {
			return array(
				1 => "1 Column",
				2 => "2 Column",
				3 => "3 Column",
				4 => "4 Column",
				5 => "5 Column",
				6 => "6 Column",
			);
		}

		function owlProperty() {
			return array(
				'loop'               => __( 'Loop', 'tlp-team-pro' ),
				'autoplay'           => __( 'Auto Play', 'tlp-team-pro' ),
				'autoplayHoverPause' => __( 'Pause on mouse hover', 'tlp-team-pro' ),
				'nav'                => __( 'Nav Button', 'tlp-team-pro' ),
				'dots'               => __( 'Pagination', 'tlp-team-pro' ),
				'autoHeight'         => __( 'Auto Height', 'tlp-team-pro' ),
				'lazyLoad'           => __( 'Lazy Load', 'tlp-team-pro' ),
				'rtl'                => __( 'Left to Right (RTL)', 'tlp-team-pro' )
			);
		}

		function scLayouts() {
			return array(
				1          => "Layout 1",
				2          => "Layout 2",
				3          => "Layout 3",
				4          => "Layout 4",
				'isotope'  => "Isotope Layout",
				'carousel' => "Carousel Slider Layout",
			);
		}

		function scOrderBy() {
			return array(
				'menu_order' => "Menu Order",
				'title'      => "Name",
				'ID'         => "ID",
				'date'       => "Date"
			);
		}

		function scOrder() {
			return array(
				'ASC'  => __( "Ascending", TLP_TEAM_SLUG ),
				'DESC' => __( "Descending", TLP_TEAM_SLUG ),
			);
		}

	}
endif;
