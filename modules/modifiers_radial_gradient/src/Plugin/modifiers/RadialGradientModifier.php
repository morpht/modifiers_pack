<?php

namespace Drupal\modifiers_radial_gradient\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the radial gradient on an element.
 *
 * @Modifier(
 *   id = "radial_gradient_modifier",
 *   label = @Translation("Radial Gradient Modifier"),
 *   description = @Translation("Provides a Modifier to set the radial gradient on an element using colors from library"),
 * )
 */
class RadialGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $css = [];
    $attributes = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['r_gradient_colors'])) {
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      // If there is only one color specified we replicate it in order to have
      // one color fill.
      if (count($config['r_gradient_colors']) === 1) {
        $css[$media][$selector][] = 'background:' . $config['r_gradient_colors'][0];
      }
      else {
        $css[$media][$selector][] = 'background:radial-gradient('
          . $config['r_gradient_shape'] . ' ' . $config['r_gradient_size']
          . ' at ' . $config['r_gradient_position'][0] . '% '
          . $config['r_gradient_position'][1] . '%, '
          . implode(',', $config['r_gradient_colors']) . ')';
      }
      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
