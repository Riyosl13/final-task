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

//UPDATE     
      // $about = \Drupal::service('custom_api.about');
      // $data['About'][] = $about->update($uid, $data);
if($data['operation'] == 'update'){
      if ($data['label'] == 'about') {
            $about_update = \Drupal::service(
                'custom_api.about'
            );
            $data[][] = $about_update->update($uid, $data);
      }
  
      if ($data['label'] == 'education') {
            $education_update = \Drupal::service(
                'custom_api.education'
            );
            $data[][] = $education_update->update($uid, $data);
      }

      if ($data['label'] == 'document') {
            $doc_update = \Drupal::service(
                'custom_api.document'
            );
            $data[][] = $doc_update->update($uid, $data);
      }

    }
//create()education
if($data['operation'] == 'create'){
      if ($data['label'] == 'education') {
        $edu_create = \Drupal::service(
            'custom_api.education'
        );
        $data[][] = $edu_create->create($uid, $data);
    }
}
      if($data['operation'] == 'create'){
        if ($data['label'] == 'document') {
          $doc_create = \Drupal::service(
              'custom_api.document'
          );
          $data[][] = $doc_create->create($uid, $data);
        }
      
  }
      

        //DELETE OPERATION
  
        if ($data['operation'] == 'delete') {
            if ($data['label'] == 'education') {
              $edu_delete = \Drupal::service('student_form.education');
              $data[][] = $edu_delete->delete($uid, $data);
            }

            if ($data['label'] == 'document') {
                $doc_delete = \Drupal::service('student_form.document');
                $data[][] = $doc_delete->delete($uid, $data);
            }
          }
        
  $data = new ModifiedResourceResponse('Success', 200);
        return $data;
    }
}