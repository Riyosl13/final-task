<?php

namespace Drupal\plugin_type_example;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for sandwhich plugins.
 */
abstract class SandwhichPluginBase extends PluginBase implements SandwhichInterface {

  /**
   * {@inheritdoc}
   */
  public function label() {
    // Cast the label to a string since it is a TranslatableMarkup object.
    return (string) $this->pluginDefinition['label'];
  }

}
