<?php

namespace Drupal\Tests\modifiers_corners\Unit;

use Drupal\modifiers_corners\Plugin\modifiers\CornersModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_corners\Plugin\modifiers\CornersModifier
 * @group modifiers_pack
 */
class CornersModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Top left and right corners.
    $actual_1 = CornersModifier::modification('.selector', [
      'corners_tl_size' => '10',
      'corners_tl_units' => 'px',
      'corners_tr_size' => '20',
      'corners_tr_units' => '%',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'border-top-left-radius:10px',
          'border-top-right-radius:20%',
        ],
        '.selector:after' => [
          'border-top-left-radius:10px',
          'border-top-right-radius:20%',
        ],
        '.selector:before' => [
          'border-top-left-radius:10px',
          'border-top-right-radius:20%',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Bottom left and right corners.
    $actual_2 = CornersModifier::modification('.selector', [
      'corners_bl_size' => '10',
      'corners_bl_units' => 'px',
      'corners_br_size' => '20',
      'corners_br_units' => '%',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'border-bottom-right-radius:20%',
          'border-bottom-left-radius:10px',
        ],
        '.selector:after' => [
          'border-bottom-right-radius:20%',
          'border-bottom-left-radius:10px',
        ],
        '.selector:before' => [
          'border-bottom-right-radius:20%',
          'border-bottom-left-radius:10px',
        ],
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEmpty($actual_2->getLibraries());
    $this->assertEmpty($actual_2->getSettings());
    $this->assertEmpty($actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
