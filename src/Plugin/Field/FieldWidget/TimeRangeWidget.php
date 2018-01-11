<?php

namespace Drupal\timerange\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * A Time Range field widget.
 *
 * @FieldWidget(
 *   id = "timerange_widget",
 *   label = @Translation("Time Range widget"),
 *   field_types = {
 *     "timerange"
 *   }
 * )
 */
class TimeRangeWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $field_items['start'] = [
      '#type' => 'time',
      '#title' => $this->t('Start'),
      '#title_display' => 'before',
      '#default_value' => isset($items[$delta]->start) ? $items[$delta]->start : NULL,
      '#description' => $this->t('E.g.: 08:00'),
    ] + $element;

    $field_items['end'] = [
      '#type' => 'time',
      '#title' => $this->t('End'),
      '#title_display' => 'before',
      '#default_value' => isset($items[$delta]->end) ? $items[$delta]->end : NULL,
      '#description' => $this->t("E.g.: 17:00. End time won't be shown if start time is empty."),
    ] + $element;

    return $field_items;
  }

}
