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
 *   description = @Translation("Provides a Modifier to set the video background on an element"),
 * )
 */
class VideoBgModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['video'])) {
      list($provider, $input) = explode(':', $config['video'], 2);
    }
    if (!empty($provider) && !empty($input)) {
      switch ($provider) {

        case 'youtube':
          preg_match('/^https?:\/\/(www\.)?((?!.*list=)youtube\.com\/watch\?.*v=|youtu\.be\/)(?<id>[0-9A-Za-z_-]*)/', $input, $matches);

          if (!empty($matches['id'])) {
            $args = [
              'provider' => $provider,
              'video' => $matches['id'],
            ];
            $provider_library = 'modifiers_bg_video/videojs_youtube';
          }
          break;
      }
      if (!empty($args)) {
        $media = parent::getMediaQuery($config);

        $css[$media][$selector][] = 'position:relative';
        $css[$media][$selector . ' .videojs-background-wrap'][] = 'position:absolute;'
          . 'overflow:hidden;width:100%;height:100%;top:0;left:0;z-index:-998';
        $libraries = [
          'modifiers_bg_video/videojs',
          'modifiers_bg_video/videojs_background',
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
        $attributes['class'][] = 'modifiers-has-background';

        return new Modification($css, $libraries, $settings, $attributes);
      }
    }
    return NULL;
  }

}
