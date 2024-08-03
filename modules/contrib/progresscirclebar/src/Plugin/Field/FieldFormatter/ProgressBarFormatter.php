<?php

namespace Drupal\progresscirclebar\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'field_progress_bar' formatter.
 *
 * @FieldFormatter(
 *   id = "field_progress_bar",
 *   module = "progresscirclebar",
 *   label = @Translation("Progress Bar"),
 *   field_types = {
 *     "string",
 *     "progresscirclebar"
 *   }
 * )
 */
class ProgressBarFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $bar_val_color = '#00ff00';
    $bar_wrapper_color = '#1A2C34';
    if (!empty(\Drupal::config('progress.settings')->get('progress_bar_wrapper'))) {
      $bar_wrapper_color = \Drupal::config('progress.settings')->get('progress_bar_wrapper');
    }
    if (!empty(\Drupal::config('progress.settings')->get('progress_bar_value'))) {
      $bar_val_color = \Drupal::config('progress.settings')->get('progress_bar_value');
    }

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        'bar_value' => $item->value,
      ];
    }

    $build = [
      '#theme' => 'progressbar',
      '#progress_items' => $elements,
      '#attached' => [
        'drupalSettings' => [
          'bar_val_color' => $bar_val_color,
          'bar_wrapper_color' => $bar_wrapper_color,
        ],
      ],
    ];

    return $build;
  }

}
