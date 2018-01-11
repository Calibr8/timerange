<?php

namespace Drupal\timerange\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the Time Range field type.
 *
 * @FieldType(
 *   id = "timerange",
 *   label = @Translation("Time Range"),
 *   description = @Translation("Time Range"),
 *   default_widget = "timerange_widget",
 *   default_formatter = "timerange_formatter"
 * )
 */
class TimeRange extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['start'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Start'));
    $properties['end'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('End'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'start' => [
          'type' => 'varchar',
          'default' => '',
          'length' => 255,
        ],
        'end' => [
          'type' => 'varchar',
          'default' => '',
          'length' => 255,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $values = [];

    $values['start'] = '12:00';
    $values['end'] = '18:00';

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {

    return empty($this->get('start')->getValue()) &&
      empty($this->get('end')->getValue());
  }

}
