<?php

namespace Drupal\custom_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\datetime\Plugin\Field\FieldFormatter\DateTimeCustomFormatter;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Plugin implementation of the 'Custom' formatter for 'datetime' fields.
 *
 * @FieldFormatter(
 *   id = "datetime_my",
 *   label = @Translation("Custom My"),
 *   field_types = {
 *     "datetime"
 *   }
 * )
 */

class CustomDateFieldFormatter extends DateTimeCustomFormatter  {


    /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    // @todo Evaluate removing this method in
    // https://www.drupal.org/node/2793143 to determine if the behavior and
    // markup in the base class implementation can be used instead.
    // $nid=1148;
    // $node_details = Node::load($nid);
    // // $node_details->field_date->value;
    // dd($node_details);
    $elements = [];
   

    foreach ($items as $delta => $item) {
      if (!empty($item->date)) {
        /** @var \Drupal\Core\Datetime\DrupalDateTime $date */
        $date = $item->date;

        $elements[$delta] = $this->buildDate($date);
      }
    }
$elements['demo'] = 'demo';
    return $elements;
  }
}