<?php

namespace Drupal\modifiers_linear_gradient\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the linear gradient on an element.
 *
 * @Modifier(
 *   id = "linear_gradient_modifier",
 *   label = @Translation("Linear Gradient Modifier"),
 *   description = @Translation("Provides a Modifier to set the linear gradient on an element"),
 * )
 */
class LinearGradientModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $css = [];
    $attributes = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['l_gradient_colors']) &&
        (count($config['l_gradient_colors']) > 1)) {
      $css[$media][$selector][] = 'background:linear-gradient(' . $config['l_gradient_direction'] . 'deg, ' . implode(',', $config['l_gradient_colors']) . ')';
      $attributes['class'][] = 'modifiers-has-background';
    }

    if (!empty($css) || !empty($attributes)) {

      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
