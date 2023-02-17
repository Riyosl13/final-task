<?php

namespace Drupal\plugin_type_example\Plugin\Sandwhich;

use Drupal\plugin_type_example\SandwhichPluginBase;

/**
 * Plugin implementation of the sandwhich.
 *
 * @Sandwhich(
 *   id = "foo",
 *   label = @Translation("Foo"),
 *   description = @Translation("Foo description.")
 * )
 */
class Foo extends SandwhichPluginBase {

}
