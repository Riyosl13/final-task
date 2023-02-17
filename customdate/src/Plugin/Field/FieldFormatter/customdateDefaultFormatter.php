<?php

namespace Drupal\customdate\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;

/**
 * Plugin implementation of the 'customdateDefaultFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "customdateDefaultFormatter",
 *   label = @Translation("customdate"),
 *   field_types = {
 *     "customdate"
 *   }
 * )
 */
class customdateDefaultFormatter extends FormatterBase {

  /**
   * Define how the field type is showed.
   * 
   * Inside this method we can customize how the field is displayed inside 
   * pages.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->myyear,
      ];
    }

    return $elements;
  }
  
} // class
