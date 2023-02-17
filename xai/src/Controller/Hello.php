<?php

namespace Drupal\xai\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MyCSVReport.
 *
 * @package Drupal\xai\Controller
 */
class Hello extends ControllerBase implements ContainerInjectionInterface
{
    /**
     * Export a CSV of data.
     */
    public function build()
    {
      $content = \Drupal::config('xai.settings')->get('bio');
    $numnodes = \Drupal::config('xai.settings')->get('nodes');
            $query = \Drupal::entityQuery('node')
  ->condition('type', $content)
  ->range(0, $numnodes)

  ->accessCheck(TRUE);
$results = $query->execute();
// dd($results);

$handle = fopen('php://temp', 'w+');

   // Set up the header that will be displayed as the first line of the CSV file.
   // Blank strings are used for multi-cell values where there is a count of
   // the "keys" and a list of the keys with the count of their usage.
   $header = [
    'Author Name',
    'NID',
    'Title',
    'Created Date',
    'Body'
   ];
   // Add the header as the first line of the CSV.
   fputcsv($handle, $header);


 
   $nodes = \Drupal::entityTypeManager()->getStorage('node')
     ->loadMultiple($results);

    // dd($nodes);
     foreach ($nodes as $node) {
      // Build the array for putting the row data together.
      $data = $this->buildRow($node);
    //  dd($data);

      // Add the data we exported to the next line of the CSV>
      fputcsv($handle, array_values($data));


  }
  // Reset where we are in the CSV.
  rewind($handle);
   
  // Retrieve the data from the file handler.
  $csv_data = stream_get_contents($handle);
      // dd($csv_data);


  // Close the file handler since we don't need it anymore.  We are not storing
  // this file anywhere in the filesystem.
  fclose($handle);

  // This is the "magic" part of the code.  Once the data is built, we can
  // return it as a response.
  $response = new Response();

  // By setting these 2 header options, the browser will see the URL
  // used by this Controller to return a CSV file called "article-report.csv".
  $response->headers->set('Content-Type', 'text/csv');
  $response->headers->set('Content-Disposition', 'attachment; filename="article-report.csv"');
  // This line physically adds the CSV data we created 
  $response->setContent($csv_data);
    // dd($response);

  return $response;
}
 /**
  * Fetches data and builds CSV row.
  *
  * @param \Drupal\node\Entity\Node $node
  *   Article node.
  *
  * @return array
  *   Row data.
  *
  * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
  * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
  */
  private function buildRow(Node $node) {
    $data = [
      'author' => $node->getOwner()->getDisplayname(),
      'nid'=>$node->id(),

      'title' => $node->label(),

      'created'=>$node->getCreatedTime(),

'body' => $node->body->value,
    ];
 
    return $data;
    }
}