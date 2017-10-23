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
 *   description = @Translation("Provides a Modifier to set the linear gradient on an element using custom colors"),
 * )
 */
class CustomLinearGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $css = [];
    $attributes = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['cl_gradient_colors'])) {
      $attributes['class'][] = 'modifiers-has-background';
      $direction = '';

      if (!empty($config['cl_gradient_direction'])) {
        $direction = $config['cl_gradient_direction'] . 'deg,';
      }
      // If there is only one color specified we replicate it in order to have
      // one color fill.
      if (count($config['cl_gradient_colors']) === 1) {
        $css[$media][$selector][] = 'background:' . $config['cl_gradient_colors'][0];
      }
      else {
        $css[$media][$selector][] = 'background:linear-gradient('
          . $direction . implode(',', $config['cl_gradient_colors']) . ')';
      }
    }

    if (!empty($css) || !empty($attributes)) {

      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
