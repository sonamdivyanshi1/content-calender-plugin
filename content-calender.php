<?php

/**
 * Plugin Name: Content Calendar Plugin
 * Description: Enables admin to create a content calendar for content publishing.
 * Version: 1.0
 * Author: Sonam Divyanshi
 */

if (!defined('WPINC')) {
    die;
}

if (!defined('My_PLUGIN_VERSION')) {
    define('My_PLUGIN_VERSION', '1.0.0');
}

if (!defined('My_PLUGIN_DIR')) {
    define('My_PLUGIN_DIR', plugin_dir_url(__FILE__));   
}


require plugin_dir_path( __FILE__ ). 'includes/script.php';
require plugin_dir_path( __FILE__ ). 'includes/form.php';
function register_my_content_calender()
{
	add_menu_page(
		__('My Content Calender'),
		'Content Calender',
		'manage_options',
		'content-calender',
		'my_content_calender',
		'dashicons-calendar-alt',
		10
	);
}
add_action('admin_menu', 'register_my_content_calender');

function my_content_calender(){

my_form();
display_table();

}
function form_data()
{
	if (isset($_POST['submit'])) {
		save_data();
	}
}
add_action('init', 'form_data');