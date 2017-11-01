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

      $libraries = [
        'modifiers_bg_parallax/parallax',
        'modifiers_bg_parallax/apply',
      ];
      $settings = [
        'namespace' => 'ParallaxBgModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => [
          'parallax' => $config['parallax'],
        ],
      ];
      if (!empty($config['parallax_speed'])) {
        $settings['args']['speed'] = $config['parallax_speed'];
      }
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification([], $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
