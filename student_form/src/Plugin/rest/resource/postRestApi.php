<?php
namespace Drupal\student_form\Plugin\rest\resource;

use Drupal\node\Entity\Node;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\user\Entity\User;
use Drupal\profile\Entity\Profile;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\File\FileSystemInterface;
use Drupal\file\Entity\File;
/**
 * Provides REST API .
 *
 * @RestResource(
 *   id = "contentpost_rest_resource",
 *   label = @Translation("Content API"),
 *   uri_paths = {
 *     "create"="/api/content/{uid}"
 *   }
 * )
 */
class postRestApi extends ResourceBase {
    public function post($uid,$data) 
    {
        // $about = \Drupal::service('student_form.about');
        // $response['About'][] = $about->update($uid, $data);

        // $about = \Drupal::service('student_form.document');
        // $response['Docs'][] = $about->update($uid, $data);
        
        $edu = \Drupal::service('student_form.education');
        $response['Education'][] = $edu->create($data);

        $response = new ModifiedResourceResponse('Values Updated', 200);
        return $response;
    }
}









