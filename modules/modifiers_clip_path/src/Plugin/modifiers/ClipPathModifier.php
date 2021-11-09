<?php

namespace Drupal\modifiers_clip_path\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to use CSS Clip Path for an element.
 *
 * @Modifier(
 *   id = "clip_path_modifier",
 *   label = @Translation("Clip Path Modifier"),
 *   description = @Translation("Provides a Modifier to use CSS Clip Path for an element."),
 * )
 */
class ClipPathModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['clip_path'])) {
      $media = parent::getMediaQuery($config);

      $css[$media][$selector][] = '-webkit-clip-path:' . $config['clip_path'];
      $css[$media][$selector][] = 'clip-path:' . $config['clip_path'];

      return new Modification($css);
    }
    return NULL;
  }

}
