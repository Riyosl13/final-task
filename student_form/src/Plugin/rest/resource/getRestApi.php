<?php

namespace Drupal\student_form\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\rest\ModifiedResourceResponse;

/**
 * Provides REST API .
 *
 * @RestResource(
 *   id = "content_rest_resource",
 *   label = @Translation("Content API"),
 *   uri_paths = {
 *     "canonical"="/api/content/{uid}"
 *   }
 * )
 */

class getRestApi extends ResourceBase
{
    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($uid)
    {
        $user = \Drupal::service('student_form.user');
        $response['User Detail'][] = $user->get($uid);

        $about = \Drupal::service('student_form.about');
        $response['About'][] = $about->get($uid);

        $education = \Drupal::service('student_form.education');
        $response['Education'][] = $education->get($uid);

        $doc = \Drupal::service('student_form.document');
        $response['Docs'][] = $doc->get($uid);

        $test = \Drupal::service('student_form.test');
        $response['Test'][] = $test->get($uid);

        $response = new ModifiedResourceResponse($response, 200);
        return $response;

        // $data = \Drupal::service('student_form.about')->get($uid);
        // $response = new ModifiedResourceResponse($data, 200);
        // return $response;
    }
}
