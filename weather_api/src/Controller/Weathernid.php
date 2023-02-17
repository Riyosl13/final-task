<?php

namespace Drupal\weather_api\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;

/**
 * The WeatherData class extends the ControllerBase.
 */
class Weathernid extends ControllerBase {

  /**
   * Function to fetch weather information.
   */
  public function con($nid) {
    // dd('hello');

    $response = file_get_contents('https://dev.sf-business.oslabs.app/api/v1/get/blogs');
    // dd($response);
    $jsonresponse = json_decode($response);
//   dd($jsonresponse); 
// if($nid == $jsonresponse->nid){
//     $data=$jsonresponse->title;
// }
return [
    '#theme' => 'weather',
    '#data' => $jsonresponse,      

  ];
  }

}
