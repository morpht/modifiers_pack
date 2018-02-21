<?php

namespace Drupal\modifiers_bg_slideshow\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to reveal elements on scroll.
 *
 * @Modifier(
 *   id = "slideshow_bg_modifier",
 *   label = @Translation("Slideshow Background Modifier"),
 *   description = @Translation("Provides a Modifier to set the slideshow
 *   background on an element."),
 * )
 */
class SlideshowBgModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['bgs_images'])) {
      $args['slides'] = $config['bgs_images'];
    }
    if (!empty($config['bgs_delay']) && !empty($config['bgs_images'])) {
      $args['delay'] = array_fill(0, count($config['bgs_images']),
        intval($config['bgs_delay']));
    }
    if (!empty($config['bgs_trans_duration'])) {
      $args['transition_duration'] = $config['bgs_trans_duration'];
    }
    if (!empty($config['bgs_trans_timing'])) {
      $args['transition_timing'] = $config['bgs_trans_timing'];
    }

    if (!empty($args)) {
      $media = parent::getMediaQuery($config);

      $libraries = [
        'modifiers_bg_slideshow/easy_background',
        'modifiers_bg_slideshow/apply',
      ];
      $settings = [
        'namespace' => 'SlideshowBgModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];

      $attributes[$media][$selector]['class'][] = 'modifiers-has-background';

      return new Modification([], $libraries, $settings, []);
    }
    return NULL;
  }

}
