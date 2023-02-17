<?php

/**
 * @file
 * Contains Drupal\custom_api\Form\SettingsForm.
 */

namespace Drupal\custom_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 *
 * @package Drupal\custom_api\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_api.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_api.settings');
    $form['baseurl'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Base Url'),
      '#default_value' => $config->get('baseurl'),
    );
     $form['path'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Path'),
      '#default_value' => $config->get('path'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('custom_api.settings')
      ->set('baseurl', $form_state->getValue('baseurl'))
      ->set('path', $form_state->getValue('path'))
    ->save();
  }

}
