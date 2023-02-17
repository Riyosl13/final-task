<?php

namespace Drupal\plugin_type_example\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines sandwhich annotation object.
 *
 * @Annotation
 */
class Sandwhich extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $title;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
