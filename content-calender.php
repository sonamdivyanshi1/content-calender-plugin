<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sonam.wisdmlabs.net
 * @since             1.0.0
 * @package           Content_Calender
 *
 * @wordpress-plugin
 * Plugin Name:       Content-calender-plugin
 * Plugin URI:        https://wordpress.org/plugins
 * Description:       Enables admin to create a content calendar for content publishing.
 * Version:           1.0.0
 * Author:            Sonam Divyanshi
 * Author URI:        https://sonam.wisdmlabs.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       content-calender
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CONTENT_CALENDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-content-calender-activator.php
 */
function activate_content_calender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-content-calender-activator.php';
	Content_Calender_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-content-calender-deactivator.php
 */
function deactivate_content_calender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-content-calender-deactivator.php';
	Content_Calender_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_content_calender' );
register_deactivation_hook( __FILE__, 'deactivate_content_calender' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-content-calender.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_content_calender() {

	$plugin = new Content_Calender();
	$plugin->run();

}
run_content_calender();
