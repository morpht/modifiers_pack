<?php

namespace Drupal\modifiers_custom_radial_gradient\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the radial gradient on an element.
 *
 * @Modifier(
 *   id = "custom_radial_gradient_modifier",
 *   label = @Translation("Custom Radial Gradient Modifier"),
 *   description = @Translation("Provides a Modifier to set the radial gradient on an element using custom colors"),
 * )
 */
class CustomRadialGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['cr_gradient_colors'])) {
      $media = parent::getMediaQuery($config);
      $shape = 'ellipse';
      $size = 'farthest-corner';
      $position_x = '50';
      $position_y = '50';

      if (!empty($config['cr_gradient_shape'])) {
        $shape = $config['cr_gradient_shape'];
      }
      if (!empty($config['cr_gradient_size'])) {
        $size = $config['cr_gradient_size'];
      }
      if (!empty($config['cr_gradient_position'][0])) {
        $position_x = $config['cr_gradient_position'][0];
      }
      if (!empty($config['cr_gradient_position'][1])) {
        $position_y = $config['cr_gradient_position'][1];
      }
      // If there is only one color specified we use single color fill.
      if (count($config['cr_gradient_colors']) === 1) {
        $css[$media][$selector][] = 'background:' . $config['cr_gradient_colors'][0];
      }
      else {
        $css[$media][$selector][] = 'background:radial-gradient('
          . $shape . ' ' . $size . ' at ' . $position_x . '% ' . $position_y . '%,'
          . implode(',', $config['cr_gradient_colors']) . ')';
      }
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
