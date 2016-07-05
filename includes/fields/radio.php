<?php
/**
 * Create a radio type element.
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
class Radio extends Fields {

	/**
	 * Markup of this field.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function html( $field ) {

		$attributes = self::get_attributes( $field );

		$output = '';

			if ( ! empty( $field->options ) && is_array( $field->options ) ) {

				foreach ( $field->options as $key => $option ) {

					$selected = checked( self::get_value( $field ), $key, false );

					$output .= '<label><input type="radio" value="'. esc_attr( $key ) .'" '.self::render_attributes( $attributes ).' '. $selected .'>'.esc_html( $option ).'</label>';

				}

			}

		return $output;

	}

}
