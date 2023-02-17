<?php
namespace Drupal\csvupload\services;
use Drupal\csvupload\services\CreateData;

/**
* @file providing the service that validates the csv imported data.
*
*/

class ValidateData {

    
       
        public function validate($item)
        {
            $title = $item['title'];
            $titlelen = strlen($title);
            $location = $item['location'];
            $loclen = strlen($location);
            $year = $item['foundation'];
            $id = $item['id'];
    
         
    
            if (
                $title == '' ||
                $titlelen > 255 ||
                $location == '' ||
                $titlelen > 255 ||
                ($year > 2023 || $year < 1990)
            ) {
                $error = [];
    
                if ($title == '' || $titlelen > 255) {
                    $message=  "Title must be entered within 255 characters at id $id. ";

                    $tit = \Drupal::logger('csvupload')->alert($message);
            
                    array_push($error, $message);

                }
    
                if ($location == '') {
                    $message2="Enter location at id $id";

                    $locs =  \Drupal::logger('csvupload')->alert($message2);

                    
                    array_push($error, $message2);
                }
    
                if ($year > 1800 || $year < 2023) {
                    $message3= " foundation year must be between 1800 and 2023 at id $id.";

                    $yr = \Drupal::logger('csvupload')->alert($message3);
                    array_push($error, $message3);
                }
                dpm("invalid data entered");
                return $error;
            } else {
                $node_create = \Drupal::service('csvupload.create')->create_node($item);
            }
        }
    
   }

 