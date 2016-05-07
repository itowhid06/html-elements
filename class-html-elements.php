<?php
/**
 * HTML Elements Library
 *
 * A helper class for outputting common HTML elements, used within WordPress.
 *
 * Copyright (c) 2016 Alessandro Tesoro
 *
 * HTML Elements Library is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * HTML Elements Library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * @author     Alessandro Tesoro <alessandro.tesoro@icloud.com>
 * @version    1.0.0
 * @copyright  (c) 2016 Alessandro Tesoro
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU LESSER GENERAL PUBLIC LICENSE
 * @package    HTML_Elements
*/

namespace AT;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HTML_Elements Class.
 *
 * @since 1.0.0
 */
class HTML_Elements {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Load class constants.
		$this->setup_constants();

		// Register an autoloader.
		spl_autoload_register( array( $this, 'autoload' ) );

	}

	/**
	 * Define library constants.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function setup_constants() {

		if ( ! defined( __NAMESPACE__ .'\HTML_HELPER_VERSION' ) ) {
			define( __NAMESPACE__ .'\HTML_HELPER_VERSION', '1.0.0' );
		}

		if ( ! defined( __NAMESPACE__ .'\HTML_HELPER_DIR' ) ) {
			define( __NAMESPACE__ .'\HTML_HELPER_DIR', plugin_dir_path( __FILE__ ) );
		}

		if ( ! defined( __NAMESPACE__ .'\HTML_HELPER_URL' ) ) {
			define( __NAMESPACE__ .'\HTML_HELPER_URL', plugin_dir_url( __FILE__ ) );
		}

	}

	/**
	 * Autoload all supported elements classes.
	 *
	 * @since 1.0.0
	 * @param  string $class class name to load.
	 */
	public function autoload( $class ) {

		$class        = ltrim( $class , '\\' );
		$partial_path = 'includes/class-';

		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
		  return;
		}

		// Retrieve class name.
		$class = str_replace( __NAMESPACE__ , '', $class );
		$class = strtolower( str_replace( '\\', '', $class ) );

		// Verify whether it's a field class.
		$is_field = ( substr( $class, 0, 6 ) == 'fields' ) ? true : false;

		// Adjust class name and path if the class being loaded is a field.
		if( $is_field ) {
		  $class        = substr( $class, 6 );
		  $partial_path = 'includes/fields/';
		}

		$file = HTML_HELPER_DIR . $partial_path . $class . '.php';

		if( file_exists( $file ) ) {
		  require( $file );
		}

	}

	/**
	 * Render a supported element.
	 *
	 * @since 1.0.0
	 * @param  string $type       	the type of element to render.
	 * @param  string $label      	label to assign to the element.
	 * @param  string $description  field description.
	 * @param  array  $attributes 	additional attributes to pass to the element.
	 * @return void
	 */
	public static function render( $type, $label, $description = '', $attributes = array() ) {

		$field = '';

		echo call_user_func( array( self::get_class_name( $type ), 'html' ), $field );

	}

	/**
	 * Retrieve the class name of a field.
	 *
	 * @since 1.0.0
	 * @param  string $field_type the type of field to retrieve.
	 * @return string        			the class name.
	 */
	private static function get_class_name( $field_type ) {

		$class_name = __NAMESPACE__ .'\\Fields\\' . ucfirst( $field_type );

		return $class_name;

	}

}

use \AT\HTML_Elements;
$test = new HTML_Elements;

$test->render( 'button', 'test' );
