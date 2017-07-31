<?php

namespace Drupal\modifiers_fonts\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the fonts on an element.
 *
 * @Modifier(
 *   id = "fonts_modifier",
 *   label = @Translation("Fonts Modifier"),
 *   description = @Translation("Provides a Modifier to set the fonts on an element"),
 * )
 */
class FontsModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    $css = [];
    $links = [];
    $media = parent::getMediaQuery($config);

    if (!empty($config['fonts_stylesheets'])) {

      foreach ($config['fonts_stylesheets'] as $stylesheet) {
        $links[] = [
          'href' => $stylesheet,
          'rel' => 'stylesheet',
        ];
      }
    }
    if (!empty($config['fonts_base'])) {
      $css[$media][$selector][] = 'font:' . $config['fonts_base'];
    }
    if (!empty($config['fonts_h1'])) {
      $css[$media][$selector . ' h1'][] = 'font:' . $config['fonts_h1'];
    }
    if (!empty($config['fonts_h2'])) {
      $css[$media][$selector . ' h2'][] = 'font:' . $config['fonts_h2'];
    }
    if (!empty($config['fonts_h3'])) {
      $css[$media][$selector . ' h3'][] = 'font:' . $config['fonts_h3'];
    }
    if (!empty($config['fonts_h4'])) {
      $css[$media][$selector . ' h4'][] = 'font:' . $config['fonts_h4'];
    }
    if (!empty($config['fonts_h5'])) {
      $css[$media][$selector . ' h5'][] = 'font:' . $config['fonts_h5'];
    }
    if (!empty($config['fonts_h6'])) {
      $css[$media][$selector . ' h6'][] = 'font:' . $config['fonts_h6'];
    }
    if (!empty($config['fonts_em'])) {
      $css[$media][$selector . ' em'][] = 'font:' . $config['fonts_em'];
    }
    if (!empty($config['fonts_strong'])) {
      $css[$media][$selector . ' strong'][] = 'font:' . $config['fonts_strong'];
    }
    if (!empty($config['fonts_h1_transform'])) {
      $css[$media][$selector . ' h1'][] = 'text-transform:' . $config['fonts_h1_transform'];
    }
    if (!empty($config['fonts_h2_transform'])) {
      $css[$media][$selector . ' h2'][] = 'text-transform:' . $config['fonts_h2_transform'];
    }
    if (!empty($config['fonts_h3_transform'])) {
      $css[$media][$selector . ' h3'][] = 'text-transform:' . $config['fonts_h3_transform'];
    }
    if (!empty($config['fonts_h4_transform'])) {
      $css[$media][$selector . ' h4'][] = 'text-transform:' . $config['fonts_h4_transform'];
    }
    if (!empty($config['fonts_h5_transform'])) {
      $css[$media][$selector . ' h5'][] = 'text-transform:' . $config['fonts_h5_transform'];
    }
    if (!empty($config['fonts_h6_transform'])) {
      $css[$media][$selector . ' h6'][] = 'text-transform:' . $config['fonts_h6_transform'];
    }

    if (!empty($css) || !empty($links)) {

      return new Modification($css, [], [], [], $links);
    }
    return NULL;
  }

}
