<?php
namespace Drupal\custom_field_formatter\Plugin\Field\FieldFormatter;
use Drupal\media\Plugin\Field\FieldFormatter\MediaThumbnailFormatter;
use Drupal\Core\Field\FieldItemListInterface;
/**
 * Plugin implementation of the 'media_thumbnail' formatter.
 *
 * @FieldFormatter(
 *   id = "custom_media_thumbnail",
 *   label = @Translation("Custom Thumbnail"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class CustomMediaThumbnailFormatter extends MediaThumbnailFormatter {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $media_items = $this->getEntitiesToView($items, $langcode);
    // Early opt-out if the field is empty.
    if (empty($media_items)) {
      return $elements;
    }
    $image_style_setting = $this->getSetting('image_style');
    /** @var \Drupal\media\MediaInterface[] $media_items */
    foreach ($media_items as $delta => $media) {
      $elements[$delta] = [
        '#theme' => 'image_formatter',
        '#item' => $media->get('thumbnail')->first(),
        '#item_attributes' => [],
        '#image_style' => $this->getSetting('image_style'),
        '#url' => $this->getMediaThumbnailUrl($media, $items->getEntity()),
      ];
      // Add cacheability of each item in the field.
      $this->renderer->addCacheableDependency($elements[$delta], $media);
    }
    // Add cacheability of the image style setting.
    if ($this->getSetting('image_link') && ($image_style = $this->imageStyleStorage->load($image_style_setting))) {
      $this->renderer->addCacheableDependency($elements, $image_style);
    }
    return $elements;
  }
}