<?php
namespace Drupal\csvupload\services;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
/**
* @file providing the service that updates the csv imported data.
*
*/

class UpdateData {

    public function update_node($item)
    {

        $nids = \Drupal::entityQuery('node')
        ->condition('title', $item['title'])
        ->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
    $intake = 'intake_course';

// foreach ($nodes as $node) {
//     $node->set('title', $item['title']);
//     $node->set('field_location', $item['location']);
//     $node->set('field_foundation',$item['foundation']);

    $p = 0;
    foreach ($item as $key => $value) {
        if (str_contains($key, $intake)) {
            $p++;
        }
    }
    if ($nodes) {
        foreach ($nodes as $node) {
            $node->set('title', $item['title']);
                $node->set('field_location', $item['location']);
                $node->set('field_foundation',$item['foundation']);
                $node->save();
            $title = $item['title'];
            $nid = $node->nid->value;
            $para = ($node->field_intake);
            foreach ($para as $value) {
                $id[] =  ($value->entity->id->value);
            }
            // dpm(count($id));
            //updating the paragraph values using for loop
            for ($i = 0; $i < count($id); $i++) {
                $paragraph = \Drupal::entityTypeManager()->getStorage('paragraph')->load($id[$i]);
                $paragraph->set('field_coursename', $item['intake_course' . $i]);
                $paragraph->set('field_courselocation', $item['courselocation' . $i]);
                $paragraph->set('field_intake_start', $item['intake_start' . $i]);
                $paragraph->set('field_intake_end', $item['intake_end' . $i]);
                $paragraph->save();
            }
         
        }
    }
}
}
