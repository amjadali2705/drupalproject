<?php

namespace Drupal\progresscirclebar\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Progress Settings Form.
 */
class ProgressSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['progress.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_progresscirclebar_configuration';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $default_circle_wrapper_color = '#1A2C34';
    $default_circle_val_color = '#00ff00';
    $default_bar_wrapper_color = '#1A2C34';
    $default_bar_val_color = '#00ff00';

    if (!empty(\Drupal::config('progress.settings')->get('progress_circle_wrapper'))) {
      $default_circle_wrapper_color = \Drupal::config('progress.settings')->get('progress_circle_wrapper');
    }
    if (!empty(\Drupal::config('progress.settings')->get('progress_circle_value'))) {
      $default_circle_val_color = \Drupal::config('progress.settings')->get('progress_circle_value');
    }
    if (!empty(\Drupal::config('progress.settings')->get('progress_bar_wrapper'))) {
      $default_bar_wrapper_color = \Drupal::config('progress.settings')->get('progress_bar_wrapper');
    }
    if (!empty(\Drupal::config('progress.settings')->get('progress_bar_value'))) {
      $default_bar_val_color = \Drupal::config('progress.settings')->get('progress_bar_value');
    }

    $form['progress']['progress_circle_wrapper'] = [
      '#title' => t("Progress Circle Wrapper Color"),
      '#type' => 'textfield',
      '#default_value' => $default_circle_wrapper_color,
    ];

    $form['progress']['progress_circle_value'] = [
      '#title' => t("Progress Circle Value Color"),
      '#type' => 'textfield',
      '#default_value' => $default_circle_val_color,
    ];

    $form['progress']['progress_bar_wrapper'] = [
      '#title' => t("Progress Bar Wrapper Color"),
      '#type' => 'textfield',
      '#default_value' => $default_bar_wrapper_color,
    ];

    $form['progress']['progress_bar_value'] = [
      '#title' => t("Progress Bar Value Color"),
      '#type' => 'textfield',
      '#default_value' => $default_bar_val_color,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $progress_circle_wrapper = $form_state->getValue('progress_circle_wrapper');
    $progress_circle_value = $form_state->getValue('progress_circle_value');
    $progress_bar_wrapper = $form_state->getValue('progress_bar_wrapper');
    $progress_bar_value = $form_state->getValue('progress_bar_value');

    // Load configuration object and save values.
    $config = \Drupal::getContainer()->get('config.factory')->getEditable('progress.settings');
    $config->set('progress_circle_wrapper', $progress_circle_wrapper)->save();
    $config->set('progress_circle_value', $progress_circle_value)->save();
    $config->set('progress_bar_wrapper', $progress_bar_wrapper)->save();
    $config->set('progress_bar_value', $progress_bar_value)->save();
    \Drupal::messenger()->addMessage('The settings have been saved!');
  }

}
