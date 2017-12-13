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
 *   description = @Translation("Provides a Modifier to set the linear gradient on an element using colors from library"),
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

    if (!empty($config['l_gradient_colors'])) {
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';
      $direction = '';

      if (!empty($config['l_gradient_direction'])) {
        $direction = $config['l_gradient_direction'] . 'deg,';
      }
      // If there is only one color specified we replicate it in order to have
      // one color fill.
      if (count($config['l_gradient_colors']) === 1) {
        $css[$media][$selector][] = 'background:' . $config['l_gradient_colors'][0];
      }
      else {
        $css[$media][$selector][] = 'background:linear-gradient('
          . $direction . implode(',', $config['l_gradient_colors']) . ')';
      }
      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
