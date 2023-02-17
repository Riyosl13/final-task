<?php
namespace Drupal\csvupload;

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\csvupload\services\ValidateData;


class addImportContent {


  public static function addImportContentItem($items, &$context){

    foreach ($items as $item)
{
  $service = \Drupal::service('csvupload.validate')->validate($item);
  $batch_size=sizeof($items);
  $batch_number=sizeof($context['results'])+1;
  $context['message'] = sprintf("Deleting %s nodes per batch. Batch #%s"
                                      , $batch_size, $batch_number);
  $context['results'][] = sizeof($items);
}
  function addImportContentItemCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = 
        "count($results)
        'One item processed.', '@count items processed."
      ;
    }
    else {
      $message = t('Finished with an error.');
    }
    // drupal_set_message($message);
    $messenger = \Drupal::service("messenger");
    $messenger->addStatus($message);


  }


  }
}



  // return true;


// This function actually creates each item as a node as type 'Page'
// function create_node($item) {


//   $node_data['type'] = 'collegeinfo';
//   $node_data['title'] = "lorem";
//   $node_data['field_foundation'] = $item['foundation'];
//   // Setting a simple textfield to add a unique ID so we can use it to query against if we want to manipulate this data again.
//   $node_data['field_unique_id']['value'] = $item['id'];
// $node_data['field_location'] = $item['location'];
//   $node = Node::create($node_data);
//   $node->setPublished(TRUE);
//   $node->save();
  


// } 
