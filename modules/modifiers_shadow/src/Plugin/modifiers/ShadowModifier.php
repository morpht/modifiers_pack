<?php

namespace Drupal\modifiers_shadow\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the shadow on an element.
 *
 * @Modifier(
 *   id = "shadow_modifier",
 *   label = @Translation("Shadow Modifier"),
 *   description = @Translation("Provides a Modifier to set the shadow on an element."),
 * )
 */
class ShadowModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   *
   * The shadow on pseudo-elements is inspired by
   * http://tobiasahlin.com/blog/how-to-animate-box-shadow.
   */
  public static function modification($selector, array $config) {

    $media = parent::getMediaQuery($config);
    $shadow = [];

    if (isset($config['shadow_offset_x'])) {
      $shadow[] = $config['shadow_offset_x'] . 'px';
    }
    if (isset($config['shadow_offset_y'])) {
      $shadow[] = $config['shadow_offset_y'] . 'px';
    }
    if (isset($config['shadow_blur'])) {
      $shadow[] = $config['shadow_blur'] . 'px';
    }
    if (isset($config['shadow_spread'])) {
      $shadow[] = $config['shadow_spread'] . 'px';
    }
    if (!empty($config['shadow_color_val'])) {
      $shadow[] = $config['shadow_color_val'];
    }
    if (count($shadow) === 5) {
      $css[$media][$selector . '::before'][] = 'content:""';
      $css[$media][$selector . '::before'][] = 'display:block';
      $css[$media][$selector . '::before'][] = 'position:absolute';
      $css[$media][$selector . '::before'][] = 'z-index:-1';
      $css[$media][$selector . '::before'][] = 'top:0';
      $css[$media][$selector . '::before'][] = 'left:0';
      $css[$media][$selector . '::before'][] = 'width:100%';
      $css[$media][$selector . '::before'][] = 'height:100%';
      $css[$media][$selector . '::before'][] = 'box-shadow:' . $shadow[0] . ' '
        . $shadow[1] . ' ' . $shadow[2] . ' ' . $shadow[3] . ' ' . $shadow[4];
      $css[$media][$selector . '::before'][] = 'opacity:1';
    }

    $shadow = [];

    if (isset($config['shadow_h_offset_x'])) {
      $shadow[] = $config['shadow_h_offset_x'] . 'px';
    }
    if (isset($config['shadow_h_offset_y'])) {
      $shadow[] = $config['shadow_h_offset_y'] . 'px';
    }
    if (isset($config['shadow_h_blur'])) {
      $shadow[] = $config['shadow_h_blur'] . 'px';
    }
    if (isset($config['shadow_h_spread'])) {
      $shadow[] = $config['shadow_h_spread'] . 'px';
    }
    if (!empty($config['shadow_h_color_val'])) {
      $shadow[] = $config['shadow_h_color_val'];
    }
    if (!empty($config['shadow_h_duration'])) {
      $shadow[] = $config['shadow_h_duration'];
    }
    if (count($shadow) === 6) {
      $css[$media][$selector][] = 'position:relative';
      $css[$media][$selector][] = 'z-index:0';
      $css[$media][$selector . '::before'][] = 'transition:opacity ' . $shadow[5] . 's ease-in-out';
      $css[$media][$selector . ':hover::before'][] = 'opacity:0';
      $css[$media][$selector . '::after'][] = 'content:""';
      $css[$media][$selector . '::after'][] = 'display:block';
      $css[$media][$selector . '::after'][] = 'position:absolute';
      $css[$media][$selector . '::after'][] = 'z-index:-1';
      $css[$media][$selector . '::after'][] = 'top:0';
      $css[$media][$selector . '::after'][] = 'left:0';
      $css[$media][$selector . '::after'][] = 'width:100%';
      $css[$media][$selector . '::after'][] = 'height:100%';
      $css[$media][$selector . '::after'][] = 'box-shadow:' . $shadow[0] . ' '
        . $shadow[1] . ' ' . $shadow[2] . ' ' . $shadow[3] . ' ' . $shadow[4];
      $css[$media][$selector . '::after'][] = 'opacity:0';
      $css[$media][$selector . '::after'][] = 'transition:opacity ' . $shadow[5] . 's ease-in-out';
      $css[$media][$selector . ':hover::after'][] = 'opacity:1';
    }

    if (!empty($css)) {
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification($css, [], [], $attributes);
    }
    return NULL;
  }

}
