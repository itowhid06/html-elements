<?php
/**
 * Abstract class to handle all the field types.
 *
 * @author     Alessandro Tesoro <alessandro.tesoro@icloud.com>
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

    $output = '<div class="wrap-' . self::get_field_id( $field ) . '-field ' . self::render_classes( $field->class ) . '">';

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

    return '</div>';

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

  /**
   * Generate the field's ID or name based on whichever is filled.
   *
   * @since 1.0.0
   * @param  object $field settings.
   * @return string
   */
  protected static function get_field_id( $field ) {

    $id_or_name = '';

    if( isset( $field->id ) && ! empty( $field->id ) ) {
      $id_or_name = $field->id;
    } else {
      $id_or_name = str_replace(' ', '_', $field->name );
    }

    return $id_or_name;

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

}
