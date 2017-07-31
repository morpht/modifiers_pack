<?php

namespace Drupal\modifiers_corners\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the corners on an element.
 *
 * @Modifier(
 *   id = "corners_modifier",
 *   label = @Translation("Corners Modifier"),
 *   description = @Translation("Provides a Modifier to set the corners on an element"),
 * )
 */
class CornersModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $css = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['corners_tl_size']) && !empty($config['corners_tl_units'])) {
      $css[$media][$selector][] = 'border-top-left-radius:' .
        $config['corners_tl_size'] . $config['corners_tl_units'];
      $css[$media][$selector . ':after'][] = 'border-top-left-radius:' .
        $config['corners_tl_size'] . $config['corners_tl_units'];
      $css[$media][$selector . ':before'][] = 'border-top-left-radius:' .
        $config['corners_tl_size'] . $config['corners_tl_units'];
    }
    if (!empty($config['corners_tr_size']) && !empty($config['corners_tr_units'])) {
      $css[$media][$selector][] = 'border-top-right-radius:' .
        $config['corners_tr_size'] . $config['corners_tr_units'];
      $css[$media][$selector . ':after'][] = 'border-top-right-radius:' .
        $config['corners_tr_size'] . $config['corners_tr_units'];
      $css[$media][$selector . ':before'][] = 'border-top-right-radius:' .
        $config['corners_tr_size'] . $config['corners_tr_units'];
    }
    if (!empty($config['corners_br_size']) && !empty($config['corners_br_units'])) {
      $css[$media][$selector][] = 'border-bottom-right-radius:' .
        $config['corners_br_size'] . $config['corners_br_units'];
      $css[$media][$selector . ':after'][] = 'border-bottom-right-radius:' .
        $config['corners_br_size'] . $config['corners_br_units'];
      $css[$media][$selector . ':before'][] = 'border-bottom-right-radius:' .
        $config['corners_br_size'] . $config['corners_br_units'];
    }
    if (!empty($config['corners_bl_size']) && !empty($config['corners_bl_units'])) {
      $css[$media][$selector][] = 'border-bottom-left-radius:' .
        $config['corners_bl_size'] . $config['corners_bl_units'];
      $css[$media][$selector . ':after'][] = 'border-bottom-left-radius:' .
        $config['corners_bl_size'] . $config['corners_bl_units'];
      $css[$media][$selector . ':before'][] = 'border-bottom-left-radius:' .
        $config['corners_bl_size'] . $config['corners_bl_units'];
    }

    if (!empty($css)) {

      return new Modification($css);
    }
    return NULL;
  }

}
