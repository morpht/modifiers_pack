<?php

namespace Drupal\Tests\modifiers_shadow\Unit;

use Drupal\modifiers_shadow\Plugin\modifiers\ShadowModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_shadow\Plugin\modifiers\ShadowModifier
 * @group modifiers_pack
 */
class ShadowModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Shadow without hover.
    $actual_1 = ShadowModifier::modification('.selector', [
      'shadow_offset_x' => '1',
      'shadow_offset_y' => '2',
      'shadow_blur' => '3',
      'shadow_spread' => '4',
      'shadow_color_val' => 'rgba(219,112,147,0.1)',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector::before' => [
          'content:""',
          'display:block',
          'position:absolute',
          'z-index:-1',
          'top:0',
          'left:0',
          'width:100%',
          'height:100%',
          'box-shadow:1px 2px 3px 4px rgba(219,112,147,0.1)',
          'opacity:1',
        ],
      ],
    ];
    $expected_attributes_1 = [
      'all' => [
        '.selector' => [
          'class' => [
            'modifiers-has-background',
          ],
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEquals($expected_attributes_1, $actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Shadow on hover.
    $actual_2 = ShadowModifier::modification('.selector', [
      'shadow_h_offset_x' => '1',
      'shadow_h_offset_y' => '2',
      'shadow_h_blur' => '3',
      'shadow_h_spread' => '4',
      'shadow_h_color_val' => 'rgba(219,112,147,0.1)',
      'shadow_h_duration' => '1',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'position:relative',
          'z-index:0',
        ],
        '.selector::before' => [
          'transition:opacity 1s ease-in-out',
        ],
        '.selector:hover::before' => [
          'opacity:0',
        ],
        '.selector::after' => [
          'content:""',
          'display:block',
          'position:absolute',
          'z-index:-1',
          'top:0',
          'left:0',
          'width:100%',
          'height:100%',
          'box-shadow:1px 2px 3px 4px rgba(219,112,147,0.1)',
          'opacity:0',
          'transition:opacity 1s ease-in-out',
        ],
        '.selector:hover::after' => [
          'opacity:1',
        ],
      ],
    ];
    $expected_attributes_2 = [
      'all' => [
        '.selector' => [
          'class' => [
            'modifiers-has-background',
          ],
        ],
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEmpty($actual_2->getLibraries());
    $this->assertEmpty($actual_2->getSettings());
    $this->assertEquals($expected_attributes_2, $actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
