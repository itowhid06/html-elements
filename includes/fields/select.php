<?php
/**
 * Create a select type element.
 *
 * @author     Alessandro Tesoro
 * @version    1.0.0
 * @copyright  (c) 2016 Alessandro Tesoro
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*/

namespace TDP\Fields;

use TDP\Fields;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Select input type.
 */
class Select extends Fields {

	/**
	 * Markup of this field.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function html( $field ) {

		$attributes = self::get_attributes( $field );

		$output = '<select '. self::render_attributes( $attributes ) .'/>';

			if ( ! empty( $field->options ) && is_array( $field->options ) ) {

				foreach ( $field->options as $key => $option ) {

					if( in_array( 'multiple', $attributes ) && is_array( self::get_value( $field ) ) ) {
						$selected = selected( true, in_array( $key, self::get_value( $field ), true ), false );
					} else {
						$selected = selected( self::get_value( $field ), $key, false );
					}

					$output .= '<option value="' . esc_attr( $key ) . '"' . $selected . '>' . esc_html( $option ) . '</option>';

				}

			}

		$output .= '</select>';

		return $output;

	}

	/**
	 * Retrieve the value for this field.
	 *
	 * @param  object $field field to work with.
	 * @return mixed
	 */
	public static function get_value( $field ) {

		return $field->value;

	}

}
