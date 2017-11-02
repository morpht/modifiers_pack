<?php

namespace Drupal\Tests\modifiers_absolute_height\Unit;

use Drupal\modifiers_absolute_height\Plugin\modifiers\AbsoluteHeightModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_absolute_height\Plugin\modifiers\AbsoluteHeightModifier
 * @group modifiers_pack
 */
class AbsoluteHeightModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Height unit is pixel.
    $actual_1 = AbsoluteHeightModifier::modification('.selector', [
      'height' => '10',
      'vertical_align' => 'top',
      'height_units' => 'px',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'display:flex',
          'align-items:flex-start',
          'height:10px',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Height unit is percentage.
    $actual_2 = AbsoluteHeightModifier::modification('.selector', [
      'height' => '20',
      'vertical_align' => 'middle',
      'height_units' => '%',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'display:flex',
          'align-items:center',
        ],
      ],
    ];
    $expected_libraries_2 = [
      'modifiers_absolute_height/apply',
    ];
    $expected_settings_2 = [
      'namespace' => 'AbsoluteHeightModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
      'args' => [
        'height' => '20',
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEquals($expected_libraries_2, $actual_2->getLibraries());
    $this->assertEquals($expected_settings_2, $actual_2->getSettings());
    $this->assertEmpty($actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
