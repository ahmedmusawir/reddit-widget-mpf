<?php 
/**
 *
 * Recent Posts Widget Class
 *
 */


/**
 * Adds Foo_Widget widget.
 */
class Reddit_Json_MPF_Widget_Body extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'reddit-widget-mpf', // Base ID
			esc_html__( 'MPF Reddit Widget', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Displays Reddit Posts', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract($instance);

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		//FOLLOWING IS GOOD FOR WP LOOPS AND SUCH ...
		// include( plugin_dir_path( __FILE__ ) . 'inc/Views/mpf-widget-frontend-display.php' );

		$data = $this->display_reddit_posts( $reddit_subject, $reddit_count );


		echo $args['after_widget'];
		
	}

	private function display_reddit_posts( $reddit_subject, $reddit_count ) {
		# code...
		if ( empty($reddit_subject) ) return false;

		$this->get_reddit_posts( $reddit_subject, $reddit_count );

	}

	private function get_reddit_posts( $reddit_subject, $reddit_count ) {
		# code...
		$reddit_posts = wp_remote_get('https://www.reddit.com/r/science.json?limit=5');
		$reddit_posts = json_decode($reddit_posts['body']);
		$reddit_posts_array = $reddit_posts->data->children;
		
		if ( isset( $reddit_posts->error ) ) return false;

		echo '<pre>';
		// print_r($reddit_posts_array);
		echo '</pre>';
		
		foreach ($reddit_posts_array as $post) {
			echo '<pre>';
			// print_r($post);
			echo '<a href="'. $post->data->url .'">' . $post->data->title . '</a>';
			// echo $post->data->url;
			echo '</pre>';

		}


	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {



		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		$reddit_subject = ! empty( $instance['reddit_subject'] ) ? $instance['reddit_subject'] : esc_html__( 'wordpress', 'text_domain' );
		$reddit_count = ! empty( $instance['reddit_count'] ) ? $instance['reddit_count'] : 5;

		include( plugin_dir_path( __FILE__ ) . 'inc/Views/mpf-widget-form-view.php' );
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['reddit_subject'] = ( ! empty( $new_instance['reddit_subject'] ) ) ? sanitize_text_field( $new_instance['reddit_subject'] ) : '';
		$instance['reddit_count'] = ( ! empty( $new_instance['reddit_count'] ) ) ? sanitize_text_field( $new_instance['reddit_count'] ) : '';

		return $instance;
	}

} // class Foo_Widget




