<?php
namespace Drupal\student_form\services;

class Document implements CrudInterface
{
  public function get($uid)
  {
    $profiletype = 'student';
    $userid = $uid;
    $currentuser = \Drupal\user\Entity\User::load($userid);
    $currentprofile = \Drupal::entityTypeManager()->getStorage('profile')->loadByUser($currentuser,$profiletype);
    // $doc = $currentprofile->get('field_doc')->entity->get('field_doc_type')->value;
    // $expiry = $currentprofile->get('field_doc')->entity->get('field_expiry_year')->value;
    // $file = $currentprofile->get('field_doc')->entity->get('field_file')->value;
    // $data= [
    //   'doc_type' => $doc,
    //   'expiry_year' => $expiry,
    //   'file' => $file,
    // ];
    // return $data;

    $paraid = $currentprofile->get('field_doc')->entity->get('id')->value;
    $doc = [];
    $document = $currentprofile->get('field_doc');

    foreach ($document as $items) {
        $doc_field = $items->entity;
        
        $docs = $doc_field->get('field_doc_type')->value;
        $expiry = $doc_field->get('field_expiry_year')->value;
        $file = $doc_field->get('field_file')->entity->getFileUri();

        $data= [
          'paragraph-id'=>$paraid,
          'doc_type' => $docs,
          'expiry_year' => $expiry,
          'file' => $file,
        ];

        array_push($doc, $data);
    }
    return $doc;
  }

  public function create($data) {
  }

  public function update($uid, $data) 
  {
    $profiletype = 'student';
    $userid = $uid;
    $currentuser = \Drupal\user\Entity\User::load($userid);
    $currentprofile = \Drupal::entityTypeManager()
        ->getStorage('profile')
        ->loadByUser($currentuser, $profiletype);

    //updating about fields
    $about = $currentprofile->field_doc->entity;
    $about->field_doc_type->value = $data['doc_type'];
    $about->field_expiry_year->value = $data['expiry_year'];
    $about->field_file->value = $data['file'];

    $about->save();

  }

  public function delete($uid) {
  }
}