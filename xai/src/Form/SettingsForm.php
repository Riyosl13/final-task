<?php

/**
 * @file
 * Contains Drupal\xai\Form\SettingsForm.
 */

namespace Drupal\xai\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class SettingsForm.
 *
 * @package Drupal\xai\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'xai.settings',
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
    $config = $this->config('xai.settings');
    $form['bio'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('enter the content type'),
      '#default_value' => $config->get('bio'),
    );
    $form['nodes'] =array(
      '#type' => 'number',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $config->get('bio'),
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

    $this->config('xai.settings')
      ->set('bio', $form_state->getValue('bio'))
      ->set('nodes', $form_state->getValue('nodes'))
      ->save();

      $form_state->setRedirect('xai.exports.articles');
      return;

  }

}
