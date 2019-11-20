<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.techmuzz.com
 * @since             1.0.0
 * @package           Aoda_Atag
 *
 * @wordpress-plugin
 * Plugin Name:       AODA Anchor Tag
 * Plugin URI:        https://github.com/techmuzz/AODA-Anchor-Tag
 * Description:       This plugin will append extra html element or content to anchor tags having external links in the post articles.
 * Version:           1.0.0
 * Author:            TechMuzz
 * Author URI:        https://www.techmuzz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aoda-atag
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
define( 'AODA_ATAG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aoda-atag-activator.php
 */
function activate_aoda_atag() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aoda-atag-activator.php';
	Aoda_Atag_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aoda-atag-deactivator.php
 */
function deactivate_aoda_atag() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aoda-atag-deactivator.php';
	Aoda_Atag_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aoda_atag' );
register_deactivation_hook( __FILE__, 'deactivate_aoda_atag' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aoda-atag.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aoda_atag() {

	$plugin = new Aoda_Atag();
	$plugin->run();

}
run_aoda_atag();
