<?php

namespace Drupal\progresscirclebar\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'field_progress_circle' formatter.
 *
 * @FieldFormatter(
 *   id = "field_progress_circle",
 *   module = "progresscirclebar",
 *   label = @Translation("Progress Circle"),
 *   field_types = {
 *     "string",
 *     "progresscirclebar"
 *   }
 * )
 */
class ProgressCircleFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $circle_val_color = '#00ff00';
    $circle_wrapper_color = '#1A2C34';
    if (!empty(\Drupal::config('progress.settings')->get('progress_circle_wrapper'))) {
      $circle_wrapper_color = \Drupal::config('progress.settings')->get('progress_circle_wrapper');
    }
    if (!empty(\Drupal::config('progress.settings')->get('progress_circle_value'))) {
      $circle_val_color = \Drupal::config('progress.settings')->get('progress_circle_value');
    }

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        'circle_value' => $item->value,
      ];
    }

    $build = [
      '#theme' => 'progresscircle',
      '#progress_items' => $elements,
      '#attached' => [
        'drupalSettings' => [
          'circle_val_color' => $circle_val_color,
          'circle_wrapper_color' => $circle_wrapper_color,
        ],
      ],
    ];

    return $build;
  }

}
