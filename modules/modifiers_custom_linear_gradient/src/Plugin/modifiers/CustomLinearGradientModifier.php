<?php

namespace Drupal\modifiers_custom_linear_gradient\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the linear gradient on an element.
 *
 * @Modifier(
 *   id = "custom_linear_gradient_modifier",
 *   label = @Translation("Custom Linear Gradient Modifier"),
 *   description = @Translation("Provides a Modifier to set the linear gradient on an element using custom colors."),
 * )
 */
class CustomLinearGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['cl_gradient_direction'])) {
      $media = parent::getMediaQuery($config);

      $args['direction'] = (float) $config['cl_gradient_direction'];
      $args['colors'] = [];

      if (!empty($config['cl_gradient_colors'])) {
        $args['colors'] = $config['cl_gradient_colors'];
      }

      $libraries = [
        'modifiers_custom_linear_gradient/apply',
      ];

      $settings = [
        'namespace' => 'CustomLinearGradientModifier',
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
