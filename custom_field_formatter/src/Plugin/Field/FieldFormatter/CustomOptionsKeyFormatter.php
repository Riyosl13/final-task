<?php

namespace Drupal\custom_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\options\Plugin\Field\FieldFormatter\OptionsKeyFormatter;

use Drupal\Core\Field\FieldFilteredMarkup;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'list_key' formatter.
 *
 * @FieldFormatter(
 *   id = "list_keycustom",
 *   label = @Translation("Custom Key"),
 *   field_types = {
 *     "list_integer",
 *     "list_float",
 *     "list_string",
 *   }
 * )
 */
class CustomOptionsKeyFormatter extends OptionsKeyFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
        $elements[$delta] = [
        '#markup' => $item->value,
        '#allowed_tags' => FieldFilteredMarkup::allowedTags(),
        '#value' => $item->value,

      ];
    }

    return $elements;
  }

}
