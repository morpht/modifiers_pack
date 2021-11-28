<?php

namespace Drupal\modifiers_color_background\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the background color on an element.
 *
 * @Modifier(
 *   id = "color_background_modifier",
 *   label = @Translation("Color Background Modifier"),
 *   description = @Translation("Provides a Modifier to set the background color on an element."),
 * )
 */
class ColorBackgroundModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $attributes = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['bc_bg_color_val'])) {
      $args['color'] = $config['bc_bg_color_val'];
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';
    }
    if (!empty($config['bc_bg_h_color_val'])) {
      $args['hover'] = $config['bc_bg_h_color_val'];
      if (empty($config['bc_bg_color_val'])) {
        $attributes[$media][$selector]['class'][] = 'modifiers-has-background';
      }
    }
    if (!empty($config['transition_duration'])) {
      $args['transition'] = $config['transition_duration'];
    }

    if (!empty($args)) {
      $css[$media][$selector . ' > *'][] = 'position:relative';
      $css[$media][$selector . ' > *'][] = 'z-index:2';
      $libraries = [
        'modifiers_color_background/apply',
      ];
      $settings = [
        'namespace' => 'ColorBackgroundModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];

      return new Modification($css, $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
