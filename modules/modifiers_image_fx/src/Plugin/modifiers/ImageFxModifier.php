<?php

namespace Drupal\modifiers_image_fx\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the image effects on an element.
 *
 * @Modifier(
 *   id = "image_fx_modifier",
 *   label = @Translation("Image FX Modifier"),
 *   description = @Translation("Provides a Modifier to set the image effects on an element"),
 * )
 */
class ImageFxModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $media = parent::getMediaQuery($config);

    if (!empty($config['image_fx_blur'])) {
      $css[$media][$selector . ' img'][] = 'filter:blur(' . $config['image_fx_blur'] . 'px)';
    }
    if (!empty($config['image_fx_brightness'])) {
      $css[$media][$selector . ' img'][] = 'filter:brightness(' . $config['image_fx_brightness'] . '%)';
    }
    if (!empty($config['image_fx_contrast'])) {
      $css[$media][$selector . ' img'][] = 'filter:contrast(' . $config['image_fx_contrast'] . '%)';
    }
    if (!empty($config['image_fx_hue_rotate'])) {
      $css[$media][$selector . ' img'][] = 'filter:hue-rotate(' . $config['image_fx_hue_rotate'] . 'deg)';
    }
    if (!empty($config['image_fx_invert'])) {
      $css[$media][$selector . ' img'][] = 'filter:invert(' . $config['image_fx_invert'] . '%)';
    }
    if (!empty($config['image_fx_grayscale'])) {
      $css[$media][$selector . ' img'][] = 'filter:grayscale(' . $config['image_fx_grayscale'] . '%)';
    }
    if (!empty($config['image_fx_saturate'])) {
      $css[$media][$selector . ' img'][] = 'filter:saturate(' . $config['image_fx_saturate'] . '%)';
    }
    if (!empty($config['image_fx_sepia'])) {
      $css[$media][$selector . ' img'][] = 'filter:sepia(' . $config['image_fx_sepia'] . '%)';
    }
    if (!empty($config['image_fx_opacity'])) {
      $css[$media][$selector . ' img'][] = 'filter:opacity(' . $config['image_fx_opacity'] . '%)';
    }
    if (!empty($config['image_fx_scale'])) {
      $css[$media][$selector . ' img'][] = 'transform:scale(' . $config['image_fx_scale'] . ')';
    }
    if (!empty($config['image_fx_h_blur'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:blur(' . $config['image_fx_h_blur'] . 'px)';
    }
    if (!empty($config['image_fx_h_brightness'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:brightness(' . $config['image_fx_h_brightness'] . '%)';
    }
    if (!empty($config['image_fx_h_contrast'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:contrast(' . $config['image_fx_h_contrast'] . '%)';
    }
    if (!empty($config['image_fx_h_hue_rotate'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:hue-rotate(' . $config['image_fx_h_hue_rotate'] . 'deg)';
    }
    if (!empty($config['image_fx_h_invert'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:invert(' . $config['image_fx_h_invert'] . '%)';
    }
    if (!empty($config['image_fx_h_grayscale'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:grayscale(' . $config['image_fx_h_grayscale'] . '%)';
    }
    if (!empty($config['image_fx_h_saturate'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:saturate(' . $config['image_fx_h_saturate'] . '%)';
    }
    if (!empty($config['image_fx_h_sepia'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:sepia(' . $config['image_fx_h_sepia'] . '%)';
    }
    if (!empty($config['image_fx_h_opacity'])) {
      $css[$media][$selector . ':hover img'][] = 'filter:opacity(' . $config['image_fx_h_opacity'] . '%)';
    }
    if (!empty($config['image_fx_h_scale'])) {
      $css[$media][$selector . ':hover img'][] = 'transform:scale(' . $config['image_fx_h_scale'] . ')';
    }
    if (!empty($config['image_fx_duration'])) {
      $css[$media][$selector . ' img'][] = 'transition-duration:' . $config['image_fx_duration'] . 's';
    }

    if (!empty($css)) {
      $css[$media][$selector . ' img'][] = '-webkit-transform:translateZ(0)';

      return new Modification($css);
    }
    return NULL;
  }

}
