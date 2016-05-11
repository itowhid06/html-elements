This class was built for my own need. Decided to share in case someone else needs something like this.

### Example usage:

This is meant to be used within a WordPress plugin so make sure you've uploaded this class and all the other files within your plugin's folder.

Then:

```
require_once( 'class-html-elements.php' );
```

Next, instantiate the class:

```
use \AT\HTML_Elements;
$elements = new HTML_Elements;
```

Now you've got access to the "render" method:

```
$render->render( 'checkbox', array(
  'id'    => 'test',
  'name'  => 'test',
  'value' => true,
  'label' => 'Checkbox label',
));
```

The render method accepts 2 parameters, the field type and an array containing the settings of the field. [Here you can find a list of supported parameters](https://github.com/alessandrotesoro/html-elements/blob/master/includes/class-fields.php#L90).

Additional attributes can be passed to each field type by using the "attributes" parameter. Example:

```
$test->render( 'text', array(
  'id'         => 'test',
  'name'       => 'test',
  'value'      => 'something',
  'label'      => 'My text field',
  'attributes' => array( 'attr' => 'value' )
) );
```
