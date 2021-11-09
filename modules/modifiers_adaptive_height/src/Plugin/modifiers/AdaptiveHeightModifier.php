<?php

namespace Drupal\modifiers_adaptive_height\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the adaptive height on an element.
 *
 * @Modifier(
 *   id = "adaptive_height_modifier",
 *   label = @Translation("Adaptive Height Modifier"),
 *   description = @Translation("Provides a Modifier to set the adaptive height on an element."),
 * )
 */
class AdaptiveHeightModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['ah_ratio'])) {
      $css = [];
      $media = parent::getMediaQuery($config);

      if (!empty($config['vertical_align'])) {
        $css[$media][$selector][] = 'display:flex';
        // Workaround for IE11.
        $css['all and (-ms-high-contrast:none),(-ms-high-contrast:active)'][$selector][] = 'height:1px';

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
        'modifiers_adaptive_height/apply',
      ];
      $settings = [
        'namespace' => 'AdaptiveHeightModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => [
          'ratio' => (float) $config['ah_ratio'],
          'limit' => '1200',
          'comparison' => 'content_width',
        ],
      ];
      if (!empty($config['ah_limit'])) {
        $settings['args']['limit'] = (int) $config['ah_limit'];
      }
      if (!empty($config['ah_comparison'])) {
        $settings['args']['comparison'] = $config['ah_comparison'];
      }

      return new Modification($css, $libraries, $settings);
    }
    return NULL;
  }

}
