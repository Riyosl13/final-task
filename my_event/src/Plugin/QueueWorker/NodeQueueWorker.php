<?php
namespace Drupal\my_event\Plugin\QueueWorker;
use Drupal\Core\Queue\QueueWorkerBase;
/**
 * Sample Queue Worker.
 *
 * @QueueWorker(
 *   id = "node_queue_worker",
 *   title = @Translation("Sample Queue Worker: Node"),
 *   cron = {"time" = 300}
 * )
 */
class NodeQueueWorker extends QueueWorkerBase {
  public function processItem($result) {
  // dd($result);
  // $itemsToDelete = \Drupal::entityTypeManager()->getStorage('node')
  // ->load($result);
  // $itemsToDelete->set('body', 'hello quques!'); 
// $itemsToDelete->save();
// dd($itemsToDelete);
// $itemsToDelete->delete();
// Loop through our entities and deleting them by calling by delete method.
$item=str_word_count($result,1);
for($i=0;$i<count($item);$i++) {

}

  }



}