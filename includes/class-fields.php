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

abstract class Field {

  public static function begin_html( $field ) {

    return "testing_open";

  }

  public static function end_html( $field ) {

    return "testing_end";

  }

}
