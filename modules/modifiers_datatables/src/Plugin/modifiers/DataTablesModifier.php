<?php

namespace Drupal\modifiers_datatables\Plugin\modifiers;

use Drupal\modifiers\Modification;
use Drupal\modifiers\ModifierPluginBase;

/**
 * Provides a Modifier to advanced interaction controls to HTML tables.
 *
 * @Modifier(
 *   id = "datatables_modifier",
 *   label = @Translation("DataTables Modifier"),
 *   description = @Translation("Provides a Modifier to advanced interaction controls to HTML tables."),
 * )
 */
class DataTablesModifier extends ModifierPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function modification($selector, array $config) {

    if (!empty($config['dt_paging'])) {
      $args['paging'] = (bool) $config['dt_paging'];
    }
    if (!empty($config['dt_searching'])) {
      $args['searching'] = (bool) $config['dt_searching'];
    }
    if (!empty($config['dt_ordering'])) {
      $args['ordering'] = (bool) $config['dt_ordering'];
    }
    if (!empty($config['dt_scroll_y'])) {
      $args['scroll_y'] = (int) $config['dt_scroll_y'];
    }
    if (!empty($config['dt_scroll_collapse'])) {
      $args['scroll_collapse'] = (bool) $config['dt_scroll_collapse'];
    }
    if (!empty($config['dt_scroll_x'])) {
      $args['scroll_x'] = (bool) $config['dt_scroll_x'];
    }
    if (!empty($config['dt_length_menu'])) {
      $args['length_menu'] = [];
      foreach ($config['dt_length_menu'] as $value) {
        $args['length_menu'][0][] = $value;
        $args['length_menu'][1][] = $value == -1 ? 'All' : $value;
      }
      $args['page_length'] = (int) $args['length_menu'][0][0];
    }

    if (!empty($args)) {
      $css = [];
      $media = parent::getMediaQuery($config);

      if (!empty($config['dt_nowrap'])) {
        $css[$media][$selector . ' th'][] = 'white-space:nowrap';
        $css[$media][$selector . ' td'][] = 'white-space:nowrap';
      }

      $libraries = [
        'modifiers_datatables/apply',
      ];
      $settings = [
        'namespace' => 'DataTablesModifier',
        'callback' => 'apply',
        'selector' => $selector,
        'media' => $media,
        'args' => $args,
      ];

      return new Modification($css, $libraries, $settings);
    }
    return NULL;
  }

}
