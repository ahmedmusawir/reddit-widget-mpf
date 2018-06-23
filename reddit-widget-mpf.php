<?php 

/**
 *
 * Plugin Name: MPF Reddit Json Widget 
 * Plugin URI:	https://htmlfivedev.com 
 * Description: Displays Reddit posts by subject
 * Version: 	1.0
 * Author URI: 	https://www.linkedin.com/in/ahmedmusawir
 * License: 	GPL-2.0+ 
 *
 */

//If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die("Cannot Access Directly");
}
// define( "PLUGIN_DIR", plugin_dir_path( __FILE__ ) );

/**
 *
 * Replace the following
 *
 */
//Reddit_Json_MPF
//reddit-widget-mpf

require_once( plugin_dir_path( __FILE__ ) . 'class-enqueue.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-reddit-widget-mpf.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-reddit-widget-mpf-body.php' );


	$setup_styles = new Reddit_Json_MPF_Widget_Enqueue();
	$setup_styles->initialize();

	$recent_post = new Reddit_Json_MPF_Widget();

// Activation
require_once plugin_dir_path( __FILE__ ) . 'inc/Base/class-activate.php';
register_activation_hook( __FILE__, array( 'Reddit_Json_MPF_Activate', 'activate' ) );

// Activation
require_once plugin_dir_path( __FILE__ ) . 'inc/Base/class-deactivate.php';
register_deactivation_hook( __FILE__, array( 'Reddit_Json_MPF_Deactivate', 'deactivate' ) );