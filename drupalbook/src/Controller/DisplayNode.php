<?php

namespace Drupal\drupalbook\Controller;

use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class DisplayNode extends ControllerBase
{
    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function load()
    {
        $client = \Drupal::httpClient();
        try {
            $response = $client->get('http://localhost:2000/api/create');
            dd($response);
            $result = json_decode($response->getBody(), TRUE);
         dd($result);
          }
          catch (RequestException $e) {
            // log exception
          }

    }
}
    
