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

		$class = ltrim( $class , '\\' );

		// Bail if class being loaded isn't coming from here.
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$namespace = explode( '\\', $class );

		foreach ( $namespace as $key => $value ) {
			if( empty( $value ) ) {
				unset( $namespace[ $key ] );
			}
		}

		// Adjust file name.
		$file_name = implode( DIRECTORY_SEPARATOR, $namespace );
		$file_name = str_replace( __NAMESPACE__ , '', $file_name );
		$file_name = strtolower( str_replace( '\\', '', $file_name ) );

		// Adjust file name for abstract class.
		if( $file_name == DIRECTORY_SEPARATOR . 'fields' ) {
			$file_name = DIRECTORY_SEPARATOR . 'class-fields';
		}

		$file_path = HTML_HELPER_DIR . 'includes' . $file_name . '.php';

		if( file_exists( $file_path ) ) {
			require_once( $file_path );
		}

	}

	/**
	 * Render a supported element.
	 *
	 * @since 1.0.0
	 * @param  string $type the type of element to render.
	 * @param  array  $args field's settings.
	 * @return void
	 */
	public static function render( $type, $args ) {

		$output           = '';
		$field_type_class = self::get_class_name( $type );

		if( ! empty ( $type ) && is_array( $args ) ) {

			// Normalize field and convert to object.
			$args = self::normalize_field( $args );

			$output  = call_user_func( array( self::get_class_name( $type ), 'begin_html' ), $args );
			$output .= call_user_func( array( self::get_class_name( $type ), 'html' ), $args );
			$output .= call_user_func( array( self::get_class_name( $type ), 'end_html' ), $args );

		}

		echo $output;

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

	/**
	 * Normalize parameters for all fields.
	 *
	 * @since 1.0.0
	 * @param  array $field field details.
	 * @return object
	 */
	private static function normalize_field( $field ) {

		$field = wp_parse_args( $field, array(
			'id'          => '',
			'name'        => '',
			'value'       => '',
			'label'       => '',
			'desc'        => '',
			'placeholder' => '',
			'class'       => '',
			'attributes'  => array(),
		) );

		return (object) $field;

	}

}

use \AT\HTML_Elements;
$test = new HTML_Elements;

$test->render( 'button', array(
	'id'=> 'lol',
	'name' => 'test',
	'class' => 'test test2',
	'label' => 'Testing label'
));
