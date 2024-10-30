<?php
/*
Plugin Name: Like This Post
Description: Advanced ajax based like functionality for posts as same as facebook does with excellent UI.
Version: 1.3
Author: Thiyagesh M
Author URI: thyash11.github.io
*/


function ltpSetOptions() {
	global $wpdb;
	$mydbname = $wpdb->prefix . 'ltp_datas';

    if ($wpdb->get_var("show tables like '$mydbname'") != $mydbname) {
		$sql = "CREATE TABLE " . $mydbname . " (
			`id` bigint(11) NOT NULL AUTO_INCREMENT,
			`post_id` int(11) NOT NULL,
			`value` int(2) NOT NULL,
			`user_id` int(11) NOT NULL,
			`date_time` datetime NOT NULL,
			PRIMARY KEY (`id`)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);	
	}
	add_option('ltp_show_ajax_notify','1');
	add_option('ltp_login_message','Please login to vote.');
	add_option('ltp_thanks_message','Thanks for voting.');
	add_option('ltp_already_liked_message','You Already Liked.');
	add_option('ltp_login_required', '1');
	add_option('ltp_show_only_count', '0');
	add_option('ltp_like_color', '#5890FF');
	add_option('ltp_unlike_previous', '0');
	add_option('ltp_unlike_message', '0');
}
function ltpReSetOptions() {
	
}
function ltpAdminRegisterSettings() {
	register_setting('ltp_options','ltp_show_ajax_notify');
	register_setting('ltp_options','ltp_login_message');
	register_setting('ltp_options','ltp_thanks_message');
	register_setting('ltp_options','ltp_already_liked_message');
	register_setting('ltp_options','ltp_login_required');
	register_setting('ltp_options','ltp_show_only_count');
	register_setting('ltp_options','ltp_like_color');
	register_setting('ltp_options','ltp_unlike_previous');
	register_setting('ltp_options','ltp_unlike_message');
}
/*---ACTIVATION, DEACTIVATION HOOKS, ADMIN OPTION REGISTER SETTINGS--*/
register_activation_hook(__FILE__, 'ltpSetOptions' );
register_activation_hook(__FILE__, 'ltpReSetOptions' );
add_action('admin_init', 'ltpAdminRegisterSettings');

function ltpSettings() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/ltp-settings.php' );
}

/*---Admin Menu and Plugin Action Links---*/
function ltpMenu() {
  add_options_page('Like this Post | Admin Settings', 'Like This Post', 'administrator', 'like-this-post', 'ltpSettings');
}
add_filter('admin_menu', 'ltpMenu');

function ltpAddActionLinks ( $actions, $plugin_file ) {
	static $plugin;
	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	
	if ($plugin == $plugin_file) {
		$mylinks = array('<a href="' . admin_url( 'options-general.php?page=like-this-post' ) . '">Settings</a>');
		$actions = array_merge( $mylinks, $actions );
	}
	return $actions;
}
add_filter( 'plugin_action_links', 'ltpAddActionLinks', 10, 5 );

/*---ADMIN CSS & SCRIPT---*/
function ltpAdminScripts() {
    wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'ltp-admin-style', plugin_dir_url( __FILE__ ) . 'css/ltp-custom.css');
    wp_enqueue_script( 'my-script-handle', plugin_dir_url( __FILE__ ) . 'js/ltp-custom.js', array('wp-color-picker'), false, true );
}
add_action( 'admin_enqueue_scripts', 'ltpAdminScripts' );

/*---LIKE THIS POST STYLE ENQUEUER---*/
function ltpAddingStyles() {
	wp_enqueue_style( 'ltp-style', plugin_dir_url( __FILE__ ) . 'css/ltp-style.css');
}
add_action( 'wp_head', 'ltpAddingStyles' );

/*---LIKE THIS POST SCRIPT ENQUEUER---*/
function ltpAddingScripts() {
	wp_register_script('ltp_ajax_script', plugins_url('js/ltp_post_ajax.js', __FILE__), array('jquery'), true);
	wp_localize_script( 'ltp_ajax_script', 'ltpajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script('ltp_ajax_script');
}
add_action( 'wp_enqueue_scripts', 'ltpAddingScripts' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/ltp-counter.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/ltp-ajax.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/ltp-view-like.php' );