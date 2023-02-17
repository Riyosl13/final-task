<?php
namespace Drupal\student_form\services;

class Test implements CrudInterface
{
  public function get($uid)
  {
    $profiletype = 'student';
    $userid = $uid;
    $currentuser = \Drupal\user\Entity\User::load($userid);
    $currentprofile = \Drupal::entityTypeManager()->getStorage('profile')->loadByUser($currentuser,$profiletype);
    
    // $taxo = $currentprofile->get('field_tests')->entity->get('field_exams')->entity->name->value;
    // $data = [
    //     'test' => $taxo,
    //   ];
    // return $response;
    
    $paraid = $currentprofile->get('field_tests')->entity->get('id')->value;   
    $test = [];
    $tests = $currentprofile->get('field_tests');

    foreach ($tests as $items) {
        $test_field = $items->entity;

        $taxo = $test_field->get('field_exams')->entity->name->value; 
        $data = [
            'paragraph-id'=> $paraid,
            'test' => $taxo,
        ];

        array_push($test, $data);
    }
    return $test;
  }

  public function create($data) {
  }

  public function update($uid, $data) {
  }

  public function delete($uid) {
  }

}