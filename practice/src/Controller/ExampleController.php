<?php

namespace Drupal\practice\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
/**
 * An practice controller.
 */
class ExampleController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    // $build = [
    //   '#markup' => $this->t('Hello World!'),
    // ];
    // return $build;
    $nid=16;
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
	$node = $node_storage->load($nid);
    // dd($node);
    dd( $node->id());  // 123Get node's bundle type:

  }

}