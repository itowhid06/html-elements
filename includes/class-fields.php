<?php
/**
 * Abstract class to handle all the field types.
 *
 * @author     Alessandro Tesor
 * @version    1.0.0
 * @copyright  (c) 2016 Alessandro Tesoro
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*/

namespace AT;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fields class to handle all field types specifications.
 *
 * @since 1.0.0
 */
abstract class Fields {

	/**
	 * Opening markup for the field's wrapper.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function begin_html( $field ) {

		$output = '<div class="wrap-' . esc_attr( $field->type ) . '-field">';

		$output .= '<label class="wp-label" for="' . esc_attr( $field->id ) . '">' . esc_html( $field->label ) . '</label>';

		return $output;

	}

	/**
	 * Markup specific to the field's type.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function html( $field ) {

		return '';

	}

	/**
	 * Closing markup for the field's wrapper.
	 *
	 * @param  object $field the field to work with.
	 * @return string
	 */
	public static function end_html( $field ) {

		$output  = ( isset( $field->desc ) && ! empty( $field->desc ) ) ? '<p class="'. self::get_field_id( $field ) .'-description" class="description">' . esc_html( $field->desc ) . '</p>': '';
		$output .= '</div>';

		return $output;

	}

	/**
	 * Return an escaped value.
	 *
	 * @param  object $field the field to work with.
	 * @return mixed        the value of the field.
	 */
	public static function value( $field ) {

		return '';

	}

	/**
	 * Normalize parameters for all fields.
	 *
	 * @param  string $type  field type.
	 * @param  array $field  settings passed when invoking the field.
	 * @return array
	 */
	public static function normalize( $type, $field ) {

		$field = wp_parse_args( $field, array(
			'id'          => '',
			'name'        => '',
			'std'         => '',
			'type'        => $type,
			'desc'        => '',
			'placeholder' => '',
			'class'       => '',
			'disabled'    => false,
			'required'    => false,
			'attributes'  => array(),
		) );

		return (object) $field;

	}

	/**
	 * Retrieve field's attributes.
	 *
	 * @param  object $field field to work with.
	 * @return array
	 */
	public static function get_attributes( $field ) {

		$attributes = wp_parse_args( $field->attributes, array(
			'disabled' => $field->disabled,
			'required' => $field->required,
			'class'    => strtolower( __NAMESPACE__.'-'.$field->type ) . ' ' . self::render_classes( $field->class ),
			'id'       => $field->id,
			'name'     => $field->name,
		) );

		return $attributes;

	}

	/**
	 * Helper method to render css classes of each field.
	 *
	 * @param  array $classes classes to render.
	 * @return string
	 */
	protected static function render_classes( $classes ) {

		$classes = implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $classes ) ) );

		return $classes;

	}

	/**
	 * Helper method to render attributes of each field.
	 *
	 * @param  array $attributes list of attributes.
	 * @return string
	 */
	protected static function render_attributes( $attributes ) {

		$output = '';

		foreach ( $attributes as $key => $value ) {

			if ( false === $value || '' === $value )
				continue;

			if ( is_array( $value ) ) {
				$value = json_encode( $value );
			}

			$output .= sprintf( true === $value ? ' %s' : ' %s="%s"', $key, esc_attr( $value ) );

		}

		return $output;

	}

}
