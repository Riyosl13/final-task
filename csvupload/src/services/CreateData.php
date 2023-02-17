<?php
namespace Drupal\csvupload\services;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
/**
* @file providing the service that validates the csv imported data.
*
*/

class CreateData {

    public function create_node($item)
    {
    
        $nids = \Drupal::entityQuery('node')
        ->condition('title', $item['title'])
        ->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
if (!$nodes) {
    $course = 'intake_course';
    $p = 0;
    foreach ($item as $key => $value) {
        if (str_contains($key, $course)) {
            $p++;
        }
    }
    $node_data['type'] = 'collegeinfo';
    $node_data['title'] = $item['title'];
    $node_data['field_location'] = $item['location'];
    $node_data['field_foundation'] =$item['foundation'];


    for ($i = 0; $i < $p; $i++) {
        if ($item['intake_course' . $i] !== ' ') {
            $courseparagraph[$i] = Paragraph::create([
                'type' => 'intake',
                'field_coursename' => $item['intake_course' . $i],
                'field_courselocation' => $item['courselocation' . $i],
                'field_intake_end' => $item['intake_end' . $i],
                'field_intake_start' => $item['intake_start' . $i],
            ]);
    
            $courseparagraph[$i]->save();
            $node_data['field_intake'][$i] = $courseparagraph[$i];


    }
    
    else {
        break;
        dpm("check csv");
    }
 
}
$node = Node::create($node_data);
$node->setPublished(true);
$node->save();
dpm("node created successfully!");
} 
else {

$node_upload = \Drupal::service('csvupload.upload')->update_node($item);

}
    }
}






 