<?php
/**
 * Plugin Name: %PLUGIN_NAME%
 * Plugin URI: %PLUGIN_URI%
 * Description: %PLUGIN_DESCRIPTION%
 * Version: 0.1.0
 * Author: %PLUGIN_AUTHOR%
 * Author URI: %AUTHOR_URI%
 * Text Domain: %TEXT_DOMAIN%
 * Domain Path: /languages/
 *
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

/*
	Copyright %YEAR%  %PLUGIN_AUTHOR% (%AUTHOR_EMAIL%)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	Permission is hereby granted, free of charge, to any person obtaining a copy of this
	software and associated documentation files (the "Software"), to deal in the Software
	without restriction, including without limitation the rights to use, copy, modify, merge,
	publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
	to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or
	substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

namespace RenVentura\%PLUGIN_NAMESPACE%;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '%PLUGIN_NAMESPACE%' ) ) :

class %PLUGIN_NAMESPACE% {

	private static $instance;

	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof %PLUGIN_NAMESPACE% ) ) {
			
			self::$instance = new %PLUGIN_NAMESPACE%;

			self::$instance->constants();
			self::$instance->includes();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Constants
	 */
	public function constants() {

		// Plugin version
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_VERSION' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_VERSION', '0.1.0' );
		}

		// Text domain
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_TEXT_DOMAIN' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN', '%TEXT_DOMAIN%' );
		}

		// Plugin file
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE', __FILE__ );
		}

		// Plugin basename
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_BASENAME' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_BASENAME', plugin_basename( %PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE ) );
		}

		// Plugin directory path
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_DIR_PATH' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_DIR_PATH', trailingslashit( plugin_dir_path( %PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE )  ) );
		}

		// Plugin directory URL
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_DIR_URL' ) ) {
			define( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_DIR_URL', trailingslashit( plugin_dir_url( %PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE )  ) );
		}

		// Templates directory
		if ( ! defined( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_TEMPLATES_DIR_PATH' ) ) {
			define ( '%PLUGIN_CONSTANT_PREFIX%_PLUGIN_TEMPLATES_DIR_PATH', %PLUGIN_CONSTANT_PREFIX%_PLUGIN_DIR_PATH . 'templates/' );
		}
	}

	/**
	 * Include/Require PHP files
	 */
	public function includes() {
		//
	}

	/**
	 * Action/filter hooks
	 */
	public function hooks() {

		register_activation_hook( %PLUGIN_CONSTANT_PREFIX%_PLUGIN_FILE, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'loaded' ) );

		// add_filter( 'plugin_action_links_' . %PLUGIN_CONSTANT_PREFIX%_PLUGIN_BASENAME, array( $this, 'action_links' ) );
		
		// add_filter( 'plugin_row_meta', array( $this, 'plugin_row_links' ), 10, 2 );
	}

	/**
	 * Run on plugin activation
	 */
	public function activate() {}

	/**
	 * Load plugin text domain
	 */
	public function loaded() {

		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN );
		
		unload_textdomain( %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN );
		
		load_textdomain( %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN, WP_LANG_DIR . '/%PLUGIN_KEY%/%PLUGIN_KEY%-' . $locale . '.mo' );
		load_plugin_textdomain( %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN, false, dirname( %PLUGIN_CONSTANT_PREFIX%_PLUGIN_BASENAME ) . '/languages' );
	}

	/**
	 * Plugin action links (under plugin's Name)
	 *
	 * @param  array 	$links 	Current links
	 *
	 * @return array        New links
	 */
	public function action_links( $links ) {

		$links[] = sprintf( '<a href="%s" aria-label="%s">%s</a>', '#', __( 'Link Text', %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN ), __( 'Link Text', %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN ) );

		return $links;
	}

	/**
	 * Plugin info row links (under plugin's Description)
	 *
	 * @param  array 	$links 	Current links
	 * @param  string 	$file  	Plugin basename
	 *
	 * @return array        New links
	 */
	public function plugin_row_links( $links, $file ) {

		if ( $file == %PLUGIN_CONSTANT_PREFIX%_PLUGIN_BASENAME ) {
			$links[] = sprintf( '<a href="%s" aria-label="%s">%s</a>', '#', __( 'Link Text', %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN ), __( 'Link Text', %PLUGIN_CONSTANT_PREFIX%_TEXT_DOMAIN ) );
		}

		return $links;
	}
}

endif;

/**
 * Main function
 * 
 * @return object 	%PLUGIN_NAMESPACE% instance
 */
function %PLUGIN_PREFIX%() {
	return %PLUGIN_NAMESPACE%::instance();
}

%PLUGIN_PREFIX%();
