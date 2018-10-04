<?php
/**
 * Facebook Likebox Widget
 *
 * @package Smart Blog
 * @since 1.0
 */

add_action( 'widgets_init', 'themepixels_register_widget_fb_likebox' );
function themepixels_register_widget_fb_likebox() {
	register_widget( 'themepixels_widget_fb_likebox' );
}

class themepixels_widget_fb_likebox extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'facebook_likebox_widget', 'description' => __( 'Display facebook likebox', 'themepixels' ) );
		parent::__construct( 'themepixels_fb_likebox', __( 'Themepixels - Facebook Likebox', 'themepixels' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$height = intval( $instance['height'] );
		$color_scheme = $instance['color_scheme'];
		$show_faces = isset( $instance['show_faces'] ) ? true : false;
		$show_header = isset( $instance['show_header'] ) ? true : false;
		$show_posts = isset( $instance['show_posts'] ) ? true : false;
		$show_border = isset( $instance['show_border'] ) ? true : false;

		echo $before_widget;
		if( $title ) {
			echo $before_title . $title . $after_title;
		} ?>

		<div class="fb-likebox-widget-wrapper">
			<?php if( $page_url ) { ?>
				<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url( $page_url ); ?>&amp;width=350&amp;height=<?php echo intval( $height ); ?>&amp;colorscheme=<?php echo esc_attr( $color_scheme ); ?>&amp;show_faces=<?php echo esc_attr( $show_faces ); ?>&amp;header=<?php echo esc_attr( $show_header ); ?>&amp;stream=<?php echo esc_attr( $show_posts ); ?>&amp;show_border=<?php echo esc_attr( $show_border ); ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:<?php echo intval( $height ); ?>px;" allowTransparency="true"></iframe>
			<?php } ?>
		</div>

		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		$instance['height'] = $new_instance['height'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_header'] = $new_instance['show_header'];
		$instance['show_posts'] = $new_instance['show_posts'];
		$instance['show_border'] = $new_instance['show_border'];

		return $instance;
	}

	public function form( $instance ) {
		$defaults =  array(
			'title'			=> '',
			'page_url'		=> '',
			'height'		=> '258',
			'color_scheme'	=> 'light',
			'show_faces'	=> 'on',
			'show_header'	=> 'off',
			'show_posts'	=> 'off',
			'show_border'	=> 'on'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'themepixels' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e( 'Page URL:', 'themepixels' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" type="text" value="<?php echo esc_url( $instance['page_url'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e( 'Height:', 'themepixels' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo intval( $instance['height'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e( 'Color Scheme:', 'themepixels' ); ?></label>
			<select name="<?php echo $this->get_field_name('color_scheme'); ?>" id="<?php echo $this->get_field_id('color_scheme'); ?>" class="widefat">
				<option value="light"<?php selected( $instance['color_scheme'], 'light' ); ?>><?php _e( 'Light', 'themepixels' ); ?></option>
				<option value="dark"<?php selected( $instance['color_scheme'], 'dark' ); ?>><?php _e( 'Dark', 'themepixels' ); ?></option>
			</select>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>"<?php checked( $instance['show_faces'], 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e( 'Show Freiend\'s Faces', 'themepixels' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>"<?php checked( $instance['show_header'], 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('show_header'); ?>"><?php _e( 'Show Header', 'themepixels' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>"<?php checked( $instance['show_posts'], 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('show_posts'); ?>"><?php _e( 'Show Posts', 'themepixels' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_border'); ?>" name="<?php echo $this->get_field_name('show_border'); ?>"<?php checked( $instance['show_border'], 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('show_border'); ?>"><?php _e( 'Show Border', 'themepixels' ); ?></label>
		</p>
	<?php
	}
}