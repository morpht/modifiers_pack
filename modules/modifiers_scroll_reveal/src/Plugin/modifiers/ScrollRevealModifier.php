<?php

namespace Drupal\modifiers_scroll_reveal\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to reveal elements on scroll.
 *
 * @Modifier(
 *   id = "scroll_reveal_modifier",
 *   label = @Translation("Scroll Reveal Modifier"),
 *   description = @Translation("Provides a Modifier to reveal elements on scroll"),
 * )
 */
class ScrollRevealModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['sr_delay'])) {
      $args['delay'] = (int) $config['sr_delay'];
    }
    if (!empty($config['sr_distance'])) {
      $args['distance'] = $config['sr_distance'];
    }
    if (!empty($config['sr_duration'])) {
      $args['duration'] = (int) $config['sr_duration'];
    }
    if (!empty($config['sr_mobile'])) {
      $args['mobile'] = (bool) $config['sr_mobile'];
    }
    if (!empty($config['sr_opacity'])) {
      $args['opacity'] = (float) $config['sr_opacity'];
    }
    if (!empty($config['sr_origin'])) {
      $args['origin'] = $config['sr_origin'];
    }
    if (!empty($config['sr_scale'])) {
      $args['scale'] = (float) $config['sr_scale'];
    }
    if (!empty($config['sr_seq_interval'])) {
      $args['interval'] = (int) $config['sr_seq_interval'];
    }
    if (!empty($config['sr_seq_selector'])) {
      $args['selector'] = $config['sr_seq_selector'];
    }

    if (!empty($args)) {
      $media = parent::getMediaQuery($config);

      $libraries = [
        'modifiers_scroll_reveal/apply',
      ];
      $settings = [
        'namespace' => 'ScrollRevealModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];

      return new Modification([], $libraries, $settings, []);
    }
    return NULL;
  }

}
