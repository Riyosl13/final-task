<?php

namespace Drupal\weather_api\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;

/**
 * The WeatherData class extends the ControllerBase.
 */
class WeatherData extends ControllerBase {

  /**
   * Function to fetch weather information.
   */
  public function content($nid) {
    // dd('hello');

    $response = file_get_contents('https://dev.sf-business.oslabs.app/api/v1/get/blogs');
    // dd($response);
    $jsonresponse = json_decode($response);
  // dd($jsonresponse); 
foreach ($jsonresponse as $data){
  $array = [
    'title' => $data->title,
    'body' => $data->body,
    'nid' => $data->nid,
]; 
$new[] = $array;
}

 
    return [
      '#theme' => 'weather_api',
      '#data' => $data,    

      '#response' => $jsonresponse,  

    ];
  }


}