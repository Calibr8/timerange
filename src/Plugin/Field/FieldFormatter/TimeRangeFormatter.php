<?php

namespace Drupal\timerange\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the Time Range formatter.
 *
 * @FieldFormatter(
 *   id = "timerange_formatter",
 *   label = @Translation("Default"),
 *   field_types = {
 *     "timerange"
 *   }
 * )
 */
class TimeRangeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'time_separator' => ':',
      'item_separator' => ' - ',
      'unit' => ' hour',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form = parent::settingsForm($form, $form_state);

    $form['time_separator'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Time separator'),
      '#description' => $this->t('Symbol to separate hours and minutes.'),
      '#default_value' => $this->getSetting('time_separator'),
    ];

    $form['item_separator'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Start - end time separator'),
      '#description' => $this->t('Symbol to separate start and end time.'),
      '#default_value' => $this->getSetting('item_separator'),
    ];

    $form['unit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unit'),
      '#description' => $this->t('Unit or abbreviation to show after both times. Translatable via User Interface Translation.'),
      '#default_value' => $this->getSetting('unit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $time_separator = $this->getSetting('time_separator');
    $item_separator = $this->getSetting('item_separator');
    $unit = $this->getSetting('unit');

    $format = sprintf('08%s00%s17%s00%s', $time_separator, $item_separator, $time_separator, $unit);
    $summary[] = t('Format: "@format".', ['@format' => $format]);

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $time_separator = $this->getSetting('time_separator');
    $item_separator = $this->getSetting('item_separator');
    $unit = $this->getSetting('unit');
    $unit = $this->t($unit);
    $element = [];

    foreach ($items as $delta => $item) {
      $start = str_replace(':', $time_separator, $item->start);
      $end = str_replace(':', $time_separator, $item->end);

      if ($end) {
        $value = $start . $item_separator . $end . $unit;
      }
      else {
        $value = $start . $unit;
      }

      $element[$delta] = [
        '#theme' => 'time',
        '#text' => $value,
        '#html' => FALSE,
      ];
    }

    return $element;
  }

}
