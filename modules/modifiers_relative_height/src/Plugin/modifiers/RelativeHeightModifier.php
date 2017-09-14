<?php

namespace Drupal\modifiers_relative_height\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the relative height on an element.
 *
 * @Modifier(
 *   id = "relative_height_modifier",
 *   label = @Translation("Relative Height Modifier"),
 *   description = @Translation("Provides a Modifier to set the relative height on an element"),
 * )
 */
class RelativeHeightModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['relative_height'])) {
      $attributes = [];
      $media = parent::getMediaQuery($config);

      if (!empty($config['vertical_align'])) {
        $attributes['class'][] = 'modifiers-vertical-align-' . $config['vertical_align'];
      }
      $libraries = [
        'modifiers_relative_height/apply',
      ];
      $settings = [
        'namespace' => 'RelativeHeightModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => [
          'ratio' => $config['relative_height'],
        ],
      ];
      $css[$media][$selector][] = 'overflow:hidden';

      return new Modification($css, $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
