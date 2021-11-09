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
 *   description = @Translation("Provides a Modifier to set the absolute height on an element."),
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
      $media = parent::getMediaQuery($config);
      $unit = 'px';

      if (!empty($config['vertical_align'])) {
        $css[$media][$selector][] = 'display:flex';

        switch ($config['vertical_align']) {

          case 'top':
            $css[$media][$selector][] = 'align-items:flex-start';
            break;

          case 'middle':
            $css[$media][$selector][] = 'align-items:center';
            break;

          case 'bottom':
            $css[$media][$selector][] = 'align-items:flex-end';
            break;
        }
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
          'media' => $media,
          'args' => [
            'height' => $config['height'],
          ],
        ];
      }
      else {
        $css[$media][$selector][] = 'height:' . $config['height'] . $unit;
      }

      return new Modification($css, $libraries, $settings);
    }
    return NULL;
  }

}
