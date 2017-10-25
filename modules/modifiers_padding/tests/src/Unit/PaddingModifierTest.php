<?php

namespace Drupal\Tests\modifiers_padding\Unit;

use Drupal\modifiers_padding\Plugin\modifiers\PaddingModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_padding\Plugin\modifiers\PaddingModifier
 * @group modifiers_pack
 */
class PaddingModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Top and bottom padding.
    $actual_1 = PaddingModifier::modification('.selector', [
      'padding_t_size' => '10',
      'padding_t_units' => 'px',
      'padding_b_size' => '20',
      'padding_b_units' => '%',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'padding-top:10px',
          'padding-bottom:20%',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Right and left padding.
    $actual_2 = PaddingModifier::modification('.selector', [
      'padding_r_size' => '10',
      'padding_r_units' => 'px',
      'padding_l_size' => '20',
      'padding_l_units' => '%',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'padding-right:10px',
          'padding-left:20%',
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
