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
      $libraries = [
        'modifiers_relative_height/apply',
      ];
      $settings = [
        'namespace' => 'RelativeHeightModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'args' => [
          'media' => $media,
          'ratio' => $config['relative_height'],
        ],
      ];
      $css[$media][$selector][] = 'overflow:hidden';

      return new Modification($css, $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
