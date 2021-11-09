<?php

namespace Drupal\modifiers_hide\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to hide an element.
 *
 * @Modifier(
 *   id = "hide_modifier",
 *   label = @Translation("Hide Modifier"),
 *   description = @Translation("Provides a Modifier to hide an element."),
 * )
 */
class HideModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (filter_var($config['hide'], FILTER_VALIDATE_BOOLEAN)) {
      $media = parent::getMediaQuery($config);

      $css[$media][$selector][] = 'display:none';

      return new Modification($css);
    }
    return NULL;
  }

}
