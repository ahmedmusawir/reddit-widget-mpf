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
		// echo $data;

		// echo date("Y-m-d H:i:s");
		// echo '<pre>';
		// print_r($data->reddit_posts);
		// echo '</pre>';	

		?>

		<style type="text/css">

			.reddit-posts-widget {
				padding-top: 1rem;
			}
			.reddit-posts-widget li {
				padding-bottom: 1rem;
			}
			.reddit-posts-widget li:hover {
				text-decoration: underline;
			}

		</style>

		<?php	

		if ( false != $data && isset($data->reddit_posts) ) {

			echo '<pre><ul class="reddit-posts-widget"><li>' 
			. implode( '</li><li>', $data->reddit_posts ) 
			. '</li><ul></pre>';
		}



		echo $args['after_widget'];
		
	}

	private function display_reddit_posts( $reddit_subject, $reddit_count ) {
		# code...
		if ( empty($reddit_subject) ) return false;

		$reddit_posts_cache = get_transient( 'recent_reddit_data' );

		// echo '<pre>';
		// print_r($reddit_posts_cache);
		// echo '</pre>';

		if ( ! $reddit_posts_cache || 
				$reddit_posts_cache->reddit_subject != $reddit_subject || 
				$reddit_posts_cache->reddit_count != $reddit_count  ) {
			
			echo "Pulling Json from Remote ...<br>";
			return $this->get_reddit_posts( $reddit_subject, $reddit_count );
		}

		return $reddit_posts_cache;

	}

	private function get_reddit_posts( $reddit_subject, $reddit_count ) {
		
		//Pulls in Json Data
		$reddit_posts = wp_remote_get("https://www.reddit.com/r/$reddit_subject.json");
		$reddit_posts = json_decode($reddit_posts['body']);
		$reddit_posts_array = $reddit_posts->data->children;
		
		//If json data fails to arrive
		if ( isset( $reddit_posts->error ) ) return false;

		
		$data = new stdClass();
		$data->reddit_subject = $reddit_subject;
		$data->reddit_count = $reddit_count;
		$data->reddit_posts = array();

		//Looping thru the Reddit Json Array
		foreach ($reddit_posts_array as $post) {

			if ( $reddit_count-- === 0 ) break;

			$post_text = '<a href="'. $post->data->url .'" target="_blank">' . $post->data->title . '</a>'; 

			$data->reddit_posts[] = $post_text;

		}

		//Stores in WP DB for 3 minutes
		set_transient( 'recent_reddit_data', $data, 60 * 1 );

		return $data;
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




