<?php
/**
 * Create a checkbox type element.
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
 * Checkbox input type.
 */
class Checkbox extends Fields {

	/**
	 * Opening markup for the field's wrapper.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function begin_html( $field ) {

		$output = '<div class="wrap-' . esc_attr( $field->type ) . '-field">';

		return $output;

	}

	/**
	 * Markup of this field.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function html( $field ) {

		$attributes = self::get_attributes( $field );

		$output = '<label class="wp-label" for="' . esc_attr( $field->id ) . '">';
		$output .= '<input type="checkbox"'. self::render_attributes( $attributes ) . checked( 1, self::get_value( $field ), false ) .'/>';
		$output .= esc_html( $field->label ) . '</label>';

		return $output;
		
	}

	/**
	 * Retrieve the value for this field.
	 *
	 * @param  object $field field to work with.
	 * @return string
	 */
	public static function get_value( $field ) {

		return $field->value;

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
		) );

		return $attributes;

	}

}
