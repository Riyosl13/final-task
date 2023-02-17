<?php

namespace Drupal\plugin_type_example;

/**
 * Interface for sandwhich plugins.
 */
interface SandwhichInterface {

  /**
   * Returns the translated plugin label.
   *
   * @return string
   *   The translated title.
   */
  public function label();

}
