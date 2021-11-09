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
 *   description = @Translation("Provides a Modifier to set the radial gradient on an element using custom colors."),
 * )
 */
class CustomRadialGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['cr_gradient_colors'])) {
      $media = parent::getMediaQuery($config);

      $args['colors'] = $config['cr_gradient_colors'];
      $args['shape'] = 'ellipse';
      $args['size'] = 'farthest-corner';
      $args['x'] = 50;
      $args['y'] = 50;

      if (!empty($config['cr_gradient_shape'])) {
        $args['shape'] = $config['cr_gradient_shape'];
      }
      if (!empty($config['cr_gradient_size'])) {
        $args['size'] = $config['cr_gradient_size'];
      }
      if (!empty($config['cr_gradient_position'][0])) {
        $args['x'] = (float) $config['cr_gradient_position'][0];
      }
      if (!empty($config['cr_gradient_position'][1])) {
        $args['y'] = (float) $config['cr_gradient_position'][1];
      }

      $libraries = [
        'modifiers_custom_radial_gradient/apply',
      ];
      $settings = [
        'namespace' => 'CustomRadialGradientModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification([], $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
