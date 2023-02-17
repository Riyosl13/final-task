<?php  
/**
 * @file
 * Contains \Drupal\customqueue\Plugin\QueueWorker\ExampleQueueWorker.
 */

namespace Drupal\customqueue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
// use Drupal\Core\File;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\Core\File\FileSystemInterface;

/**
 * Processes tasks for example module.
 *
 * @QueueWorker(
 *   id = "example_queue",
 *   title = @Translation("Example: Queue worker"),
 *   cron = {"time" = 90}
 * )
 */
class ExampleQueueWorker extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($item) {
    //dd($item);
    for($i=0;$i<count($item);$i++) {
    $url = $item[$i]['uri'];
// dd($url);
}

$data = file_get_contents($url);
    
$file = file_save_data($data, "public://image2".rand()."png", FileSystemInterface::EXISTS_REPLACE);

$field_blogimg = array(
  'target_id' => $file->id(),
  'alt' => "My 'alt'",
  'title' => "My 'title'",
);
// $query = \Drupal::entityQuery('node')
// ->condition('type', 'blog')
// ->condition('status', 1)
// ->accessCheck(FALSE);
// $nids = $query->execute();
// //  dd($nids);

// $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
// // dd($nodes);
// foreach ($nodes as $node) {
  $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
  // dd($nodes);
  // foreach($nodes as $node){
	$nid = 15;     // example value
  $node = \Drupal\node\Entity\Node::load($nid);

$node->field_blogimg = $field_blogimg;

$node->setPublished(TRUE);
$node->save();
  // }
}
}