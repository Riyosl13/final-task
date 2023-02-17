<?php

namespace Drupal\cleanplus\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
/**
 * The ArticleData class extends the ControllerBase.
 */
class CleanData extends ControllerBase {

  /**
   * Function to fetch article information.
   */
  public function content() {

    
    $article = [];
    // dd('hello');
      $response = $client->get('https://dev.sf-business.oslabs.app/api/v1/get/blogs');
      $result = json_decode($response->getBody(), TRUE);
      //dd($result);
      // foreach($result['results'] as $item) {
      //   $people[] = $item['name']; 
      // }
  

    // return [
    //   '#theme' => 'clean_api',
    //   '#items' => $result,
    //   '#title' => $this->t('All articles'),
    // ];
  }

}
