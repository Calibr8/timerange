<?php

namespace Drupal\timerange\Element;

use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Render\Element;

/**
 * Provides Time form element.
 *
 * @FormElement("time")
 */
class Time extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#theme' => 'input__date',
      '#process' => [
        [$class, 'processAjaxForm'],
      ],
      '#pre_render' => [[$class, 'preRenderTime']],
      '#theme_wrappers' => ['form_element'],
      '#attributes' => [
        'type' => 'time',
        'pattern' => '[0-9]{2}:[0-9]{2}',
        'min' => '00:00',
        'max' => '23:59',
      ],
    ];
  }

  /**
   * Adds form-specific attributes to a 'time' #type element.
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used:, #value, #required, #attributes, #id, #name, #type,
   *   #min, #max, #pattern, #value.
   *   The #name property will be sanitized before output. This is currently
   *   done by initializing Drupal\Core\Template\Attribute with all the
   *   attributes.
   *
   * @return array
   *   The $element with prepared variables ready for #theme 'input__date'.
   */
  public static function preRenderTime(array $element) {
    if (empty($element['#attributes']['type'])) {
      $element['#attributes']['type'] = 'time';
    }

    Element::setAttributes($element, ['id', 'name', 'type', 'min', 'max', 'pattern', 'value']);
    static::setAttributes($element, ['form-' . $element['#attributes']['type']]);

    return $element;
  }

}
