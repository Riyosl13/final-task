<?php
namespace Drupal\student_form\services;

class About implements CrudInterface
{
    public function get($uid)
    {
        $profiletype = 'student';
        $userid = $uid;
        $currentuser = \Drupal\user\Entity\User::load($userid);
        $currentprofile = \Drupal::entityTypeManager()
            ->getStorage('profile')
            ->loadByUser($currentuser, $profiletype);
        $paraid = $currentprofile->get('field_about')->entity->get('id')->value;
        $name = $currentprofile->get('field_about')->entity->get('field_name')
            ->value;
        $address = $currentprofile
            ->get('field_about')
            ->entity->get('field_address')->value;
        $bio = $currentprofile->get('field_about')->entity->get('field_bio')
            ->value;
        $dob = $currentprofile->get('field_about')->entity->get('field_dob')
            ->value;

        $data = [
            'paragraph-id' => $paraid,
            'name' => $name,
            'address' => $address,
            'bio' => $bio,
            'dob' => $dob,
        ];

        return $data;
    }

    public function create($data)
    {
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
        $about = $currentprofile->field_about->entity;
        $about->field_address->value = $data['address'];
        $about->field_bio->value = $data['bio'];
        $about->field_dob->value = $data['dob'];
        $about->field_name->value = $data['name'];

        $about->save();

    }

    public function delete($uid)
    {
    }
}
