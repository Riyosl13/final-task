<?php

namespace Drupal\student_form\services;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\profile\Entity\Profile;

class Education implements CrudInterface
{
    public function get($uid)
    {
        $profiletype = 'student';
        $userid = $uid;
        $currentuser = \Drupal\user\Entity\User::load($userid);
        $currentprofile = \Drupal::entityTypeManager()
            ->getStorage('profile')
            ->loadByUser($currentuser, $profiletype);

        //GETTING SINGLE VALUES
        // $college = $currentprofile->get('field_education')->entity->get('field_college')->value;
        // $degree = $currentprofile->get('field_education')->entity->get('field_degree')->value;
        // $documents = $currentprofile->get('field_education')->entity->get('field_document')->value;
        // $year = $currentprofile->get('field_education')->entity->get('field_year')->value;
        // $data = [
        //   'college' => $college,
        //   'degree' => $degree,
        //   'documents' => $documents,
        //   'year' => $year,
        // ];
        // return $data;

        //MULTIVALUES
        $paraid = $currentprofile->get('field_education')->entity->get('id')
            ->value;
        $edu = [];
        $education = $currentprofile->get('field_education');

        foreach ($education as $item) {
            $edu_field = $item->entity;

            $college = $edu_field->get('field_college')->value;
            $degree = $edu_field->get('field_degree')->value;
            $documents = $edu_field->get('field_document')->entity->uri->value;
            $year = $edu_field->get('field_year')->value;

            $data = [
                'paragraph-id' => $paraid,
                'college' => $college,
                'degree' => $degree,
                'documents' => $documents,
                'year' => $year,
            ];

            array_push($edu, $data);
        }

        return $edu;
    }

    public function create($data)
    {
        $education = Paragraph::create(
          [               
              'type' => 'education',
              'field_college' => [
                  'value' => 'IIT Kanpur',
              ],
              'field_degree' => [
                  'value' => 'B.Tech',
              ],
              'field_year' => [
                  'value' => '2000-06-28',
              ],
                 
                // 'type' => 'education',
                // 'field_college' => [
                //     'value' => 'IIT Indore',
                // ],
                // 'field_degree' => [
                //     'value' => 'M.Tech',
                // ],
                // 'field_year' => [
                //     'value' => '2022-8-21',
                // ],                  
          ]
        );
        $education->save();

        $newprofile = Profile::create(
          [
            'type' => 'student',
            'field_title' => 'NewProfile',
            'field_education'  => $education,
            ]
          
        );
        $newprofile->save();
    }

    public function update($uid, $data)
    {
    }

    public function delete($uid)
    {
    }
}
