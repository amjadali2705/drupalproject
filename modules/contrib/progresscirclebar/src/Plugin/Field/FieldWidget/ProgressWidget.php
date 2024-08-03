<?php

namespace Drupal\progresscirclebar\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_progress_text' widget.
 *
 * @FieldWidget(
 *   id = "field_progress_text",
 *   module = "progresscirclebar",
 *   label = @Translation("Progress Value"),
 *   field_types = {
 *     "string",
 *     "progresscirclebar"
 *   }
 * )
 */
class ProgressWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->value ?? '';
    $element += [
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => 7,
      '#maxlength' => 7,
      '#element_validate' => [
      [$this, 'validate'],
      ],
    ];
    return ['value' => $element];
  }

  /**
   * Validate the color text field.
   */
  public function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) === 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
    if (!is_numeric($value)) {
      $form_state->setError($element, $this->t('Only numbers are allowed!'));
    }
    if ($value > 100 || $value < 0) {
      $form_state->setError($element, $this->t('Provide a number between 0 to 100!'));
    }
  }

}
