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
   * @param  [type] $field [description]
   * @return string
   */
  public static function begin_html( $field ) {

    return '';

  }

  /**
   * Markup specific to the field's type.
   *
   * @param  [type] $field [description]
   * @return string
   */
  public static function html( $field ) {

    return '';

  }

  /**
   * Closing markup for the field's wrapper.
   *
   * @param  [type] $field [description]
   * @return string
   */
  public static function end_html( $field ) {

    return '';

  }

  /**
   * Helper method to render attributes of each field.
   *
   * @param  array $attributes list of attributes.
   * @return string
   */
  public static function render_attributes( $attributes ) {

  }

}
