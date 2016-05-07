<?php
/**
 * Create a button type element.
 *
 * @author     Alessandro Tesoro <alessandro.tesoro@icloud.com>
 * @version    1.0.0
 * @copyright  (c) 2016 Alessandro Tesoro
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*/

namespace AT\Fields;

use AT\Fields;

class Button extends Fields {

  public static function html( $field ) {

    return 'button_content';

  }

}
