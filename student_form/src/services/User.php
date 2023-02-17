<?php
namespace Drupal\student_form\services;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Entity\EntityTypeManager;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class User implements CrudInterface
{
    public function get($uid)
    {
        $userid = $uid;
        $currentuser = \Drupal\user\Entity\User::load($userid);
        $fname = $currentuser->field_first_name->value;
        $lname = $currentuser->field_last_name->value;
        $name = $currentuser->name->value;
        $pass = $currentuser->pass->value;
        $mail = $currentuser->mail->value;
        $data = [
            'First Name'=> $fname,
            'Last Name'=> $lname,
            'Username' => $name,
            'e-mail' => $mail,
            'Password' => $pass,         
        ];
        return $data;
    }

    public function create($data)
    {
    }

    public function update($uid, $data)
    {
    }

    public function delete($uid)
    {
    }
}









