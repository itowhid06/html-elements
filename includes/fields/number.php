<?php
/**
 * Create a number type element.
 *
 * @author     Alessandro Tesoro
 * @version    1.0.0
 * @copyright  (c) 2016 Alessandro Tesoro
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*/

namespace AT\Fields;

use AT\Fields;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Number input type.
 */
class Number extends Fields {

	/**
	 * Markup of this field.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function html( $field ) {

		$attributes = self::get_attributes( $field );

		return '<input type="number"'. self::render_attributes( $attributes ) .'/>';

	}

	/**
	 * Retrieve the value for this field.
	 *
	 * @param  object $field field to work with.
	 * @return string
	 */
	public static function get_value( $field ) {

		return esc_attr( $field->value );

	}

	/**
	 * Modify the attributes for this field.
	 *
	 * @param  object $field the field to work with.
	 * @return array
	 */
	public static function get_attributes( $field ) {

		$attributes = parent::get_attributes( $field );

		$attributes = wp_parse_args( $attributes, array(
			'value' => parent::get_value( $field ),
			'min'   => 0,
			'max'   => false,
			'step'  => 1
		) );

		return $attributes;

	}

}
