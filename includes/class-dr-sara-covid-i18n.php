<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://khadkaravi.com.np/
 * @since      1.0.0
 *
 * @package    Dr_Sara_Covid
 * @subpackage Dr_Sara_Covid/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dr_Sara_Covid
 * @subpackage Dr_Sara_Covid/includes
 * @author     Developer Ravi <khadkaravi170@gmail.com>
 */
class Dr_Sara_Covid_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dr-sara-covid',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
