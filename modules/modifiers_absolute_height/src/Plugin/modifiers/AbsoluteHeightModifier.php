<?php

namespace Drupal\modifiers_absolute_height\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the absolute height on an element.
 *
 * @Modifier(
 *   id = "absolute_height_modifier",
 *   label = @Translation("Absolute Height Modifier"),
 *   description = @Translation("Provides a Modifier to set the absolute height on an element"),
 * )
 */
class AbsoluteHeightModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['height'])) {
      $css = [];
      $libraries = [];
      $settings = [];
      $attributes = [];
      $media = parent::getMediaQuery($config);
      $unit = 'px';

      if (!empty($config['vertical_align'])) {
        $attributes['class'][] = 'modifiers-vertical-align-' . $config['vertical_align'];
      }
      if (!empty($config['height_units'])) {
        $unit = $config['height_units'];
      }
      if ($unit === '%') {
        $libraries = [
          'modifiers_absolute_height/apply',
        ];
        $settings = [
          'namespace' => 'AbsoluteHeightModifier',
          'callback' => 'apply',
          'selector' => $selector,
          'args' => [
            'media' => $media,
            'height' => $config['height'],
          ],
        ];
      }
      else {
        $css[$media][$selector][] = 'height:' . $config['height'] . $unit;
      }

      return new Modification($css, $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
