<?php

namespace Drupal\customdate\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'customdateDefaultWidget' widget.
 *
 * @FieldWidget(
 *   id = "customdateDefaultWidget",
 *   label = @Translation("customdate select"),
 *   field_types = {
 *     "customdate"
 *   }
 * )
 */
class customdateDefaultWidget extends WidgetBase {

  /**
   * Define the form for the field type.
   * 
   * Inside this method we can define the form used to edit the field type.
   * 
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta, 
    Array $element, 
    Array &$form, 
    FormStateInterface $formState
  ) {

    // myyear
    $currentYear = date('Y');
    $value =array();
    // foreach (range(1950, $currentYear) as $value) {
    // $value ;
    // }
    for($i = $currentYear-100;$i<=$currentYear;$i++){
      $value[$i]=$i;
    }
    $element['myyear'] = [
      '#type' => 'select',
      '#title' => t('CustomYear'),
   
    '#options' =>   $value,

      // Set here the current value for this field, or a default value (or 
      // null) if there is no a value
      '#default_value' => isset($items[$delta]->myyear) ? 
          $items[$delta]->myyear : null,

      '#empty_value' => '',
      '#placeholder' => t('my dropdown year'),
    ];


    return $element;
  }

} // class