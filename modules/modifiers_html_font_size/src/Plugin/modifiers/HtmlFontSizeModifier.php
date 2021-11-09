<?php

namespace Drupal\modifiers_html_font_size\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the HTML font size on an element.
 *
 * @Modifier(
 *   id = "html_font_size_modifier",
 *   label = @Translation("HTML Font Size Modifier"),
 *   description = @Translation("Provides a Modifier to set the HTML font size on an element."),
 * )
 */
class HtmlFontSizeModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['fonts_base_size'])) {
      $media = parent::getMediaQuery($config);

      $css[$media][$selector][] = 'font-size:' . $config['fonts_base_size'] . '!important';

      return new Modification($css);
    }
    return NULL;
  }

}
