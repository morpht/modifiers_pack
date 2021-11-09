<?php

namespace Drupal\modifiers_bg_video\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to set the video background on an element.
 *
 * @Modifier(
 *   id = "video_bg_modifier",
 *   label = @Translation("Video Background Modifier"),
 *   description = @Translation("Provides a Modifier to set the video background on an element."),
 * )
 */
class VideoBgModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['video'])) {
      $media = parent::getMediaQuery($config);

      preg_match('/^https?:\/\/(www\.)?((?!.*list=)youtube\.com\/watch\?.*v=|youtu\.be\/)(?<id>[0-9A-Za-z_-]*)/', $config['video'], $matches);

      if (!empty($matches['id'])) {
        $args = [
          'provider' => 'youtube',
          'video' => $matches['id'],
        ];
        $provider_library = 'modifiers_bg_video/videojs_youtube';
      }
      else {
        preg_match('/^https?:\/\/(www\.)?vimeo\.com\/(.*\/)?(?<id>[0-9]+)/', $config['video'], $matches);

        if (!empty($matches['id'])) {
          $args = [
            'provider' => 'vimeo',
            'video' => $matches['id'],
          ];
          $provider_library = 'modifiers_bg_video/videojs_vimeo';
          $css[$media][$selector . ' .vjs-vimeo'][] = 'width:100%';
        }
      }

      if (!empty($args)) {
        if (!empty($config['bgv_color_val'])) {
          $css[$media][$selector][] = 'background-color:' . $config['bgv_color_val'];
        }
        if (!empty($config['bgv_image'])) {
          $args['image'] = $config['bgv_image'];
        }
        $css[$media][$selector][] = 'position:relative';
        $css[$media][$selector][] = 'z-index:1';
        $css[$media][$selector . ' .videojs-background-wrap'][] = 'position:absolute;'
          . 'overflow:hidden;width:100%;height:100%;top:0;left:0;z-index:-998';
        $libraries = [
          'modifiers_bg_video/apply',
        ];
        if (!empty($provider_library)) {
          $libraries[] = $provider_library;
        }
        $settings = [
          'namespace' => 'VideoBgModifier',
          'callback' => 'apply',
          'selector' => $selector,
          'media' => $media,
          'args' => $args,
        ];
        $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

        return new Modification($css, $libraries, $settings, $attributes);
      }
    }
    return NULL;
  }

}
