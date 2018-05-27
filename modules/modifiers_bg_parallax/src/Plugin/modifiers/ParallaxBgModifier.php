<?php

namespace Drupal\modifiers_bg_parallax\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the parallax background on an element.
 *
 * @Modifier(
 *   id = "parallax_bg_modifier",
 *   label = @Translation("Parallax Background Modifier"),
 *   description = @Translation("Provides a Modifier to set the parallax background on an element"),
 * )
 */
class ParallaxBgModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['parallax'])) {
      $media = parent::getMediaQuery($config);

      $css[$media][$selector][] = 'background-image:url("' . $config['parallax'] . '")';

      $libraries = [
        'modifiers_bg_parallax/parallax',
        'modifiers_bg_parallax/apply',
      ];
      $settings = [
        'namespace' => 'ParallaxBgModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => [],
      ];
      if (!empty($config['parallax_speed'])) {
        $settings['args']['speed'] = floatval($config['parallax_speed']);
      }
      if (!empty($config['bgp_color_val'])) {
        $css[$media][$selector][] = 'background-color:' . $config['bgp_color_val'];
      }
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification($css, $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
