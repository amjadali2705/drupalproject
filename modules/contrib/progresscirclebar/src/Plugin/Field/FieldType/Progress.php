<?php

namespace Drupal\progresscirclebar\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field type of progress.
 *
 * @FieldType(
 *   id = "progresscirclebar",
 *   label = @Translation("Progress Circle/Bar field"),
 *   module = "progresscirclebar",
 *   description = @Translation("Demonstrates a field to create progress circle or bar"),
 *   default_formatter = "field_progress_circle",
 *   default_widget = "field_progress_text",
 * )
 */
class Progress extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      // Columns contains the values that the field will store.
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Value'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      // Declare a single setting, 'size', with a default
      // value of 'large'.
      'size' => 'large',
    ] + parent::defaultFieldSettings();
  }

}
