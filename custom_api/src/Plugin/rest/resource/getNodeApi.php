<?php
namespace Drupal\custom_api\Plugin\rest\resource;

use Drupal\node\Entity\Node;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\file\Entity\File;
/**
 * Provides REST API .
 *
 * @RestResource(
 *   id = "node_rest_resource",
 *   label = @Translation("Get node"),
 *   uri_paths = {
 *     "canonical"="/api/getnode"
 *   }
 * )
 */
class getNodeApi extends ResourceBase {
    
        public function get() {
            $response = ['message' => 'Hello, this is a rest service'];
            return new ResourceResponse($response);
          
        
    }
}