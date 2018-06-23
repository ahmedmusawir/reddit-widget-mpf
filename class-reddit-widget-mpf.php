<?php 
/**
 * Widget Main Class
 */
class Reddit_Json_MPF_Widget
{
	
	function __construct()
	{
		add_action( 'widgets_init', array( $this, 'mpf_recent_post_widget' ) );
	}

	public function mpf_recent_post_widget() {
		
		register_widget( 'Reddit_Json_MPF_Widget_Body' );
	}
}