<?php

namespace Drupal\modifiers_bg_image\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the image background on an element.
 *
 * @Modifier(
 *   id = "image_bg_modifier",
 *   label = @Translation("Image Background Modifier"),
 *   description = @Translation("Provides a Modifier to set the image background on an element."),
 * )
 */
class ImageBgModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['image'])) {
      $media = parent::getMediaQuery($config);

      $args['image'] = $config['image'];

      if (!empty($config['image_style'])) {

        switch ($config['image_style']) {

          case 'stretch':
            $args['size'] = 'cover';
            break;

          case 'no-repeat':
          case 'repeat':
          case 'repeat-x':
          case 'repeat-y':
            $args['repeat'] = $config['image_style'];
            break;
        }
      }
      if (!empty($config['image_position'])) {
        $args['position'] = str_replace('-', ' ', $config['image_position']);
      }
      if (!empty($config['bgi_color_val'])) {
        $args['color'] = $config['bgi_color_val'];
      }

      $libraries = [
        'modifiers_bg_image/apply',
      ];
      $settings = [
        'namespace' => 'ImageBgModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];
      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification([], $libraries, $settings, $attributes);
    }
    return NULL;
  }

}
