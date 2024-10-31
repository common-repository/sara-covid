<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://khadkaravi.com.np/
 * @since             1.0.0
 * @package           Dr_Sara_Covid
 *
 * @wordpress-plugin
 * Plugin Name:       SARA Covid
 * Plugin URI:        drsaracovid
 * Description:       The main propose of this plugin is to view COVID-19 case statistics in worldwide. you can easily install the plugin and use the shortcode to view the data on their website.our latest version with more features will be coming soon. This plugin is free to use.

DR SARA COVID plugin communicates with an API. This API does not send any personal or identifiable information.source data from Johns Hopkins University, the New York Times, and Worldometers to give you a comphrehensive view of the data. 
 * Version:           1.4
 * Author:            Sarala & Ravi
 * Author URI:        http://khadkaravi.com.np/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dr-sara-covid
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
define( 'DR_SARA_COVID_VERSION', '1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dr-sara-covid-activator.php
 */
function activate_dr_sara_covid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dr-sara-covid-activator.php';
	Dr_Sara_Covid_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dr-sara-covid-deactivator.php
 */
function deactivate_dr_sara_covid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dr-sara-covid-deactivator.php';
	Dr_Sara_Covid_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dr_sara_covid' );
register_deactivation_hook( __FILE__, 'deactivate_dr_sara_covid' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dr-sara-covid.php';
require plugin_dir_path( __FILE__ ) . 'admin/dr-sara-covid.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dr_sara_covid() {

	$plugin = new Dr_Sara_Covid();
	$plugin->run();

}
run_dr_sara_covid();
