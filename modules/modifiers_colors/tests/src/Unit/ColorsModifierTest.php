<?php

namespace Drupal\Tests\modifiers_colors\Unit;

use Drupal\modifiers_colors\Plugin\modifiers\ColorsModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_colors\Plugin\modifiers\ColorsModifier
 * @group modifiers_pack
 */
class ColorsModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Background color is empty.
    $actual_1 = ColorsModifier::modification('.selector', [
      'text_color' => 'rgba(255,20,147,0.2)',
      'link_color' => 'rgba(255,102,170,0.3)',
      'h_link_color' => 'rgba(255,20,147,0.5)',
      'h_text_color' => 'rgba(255,102,170,0.6)',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'color:rgba(255,20,147,0.2)',
        ],
        '.selector a' => [
          'color:rgba(255,102,170,0.3)',
        ],
        '.selector:hover' => [
          'color:rgba(255,102,170,0.6)',
        ],
        '.selector a:hover' => [
          'color:rgba(255,20,147,0.5)',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Background color is not empty.
    $actual_2 = ColorsModifier::modification('.selector', [
      'background_color' => 'rgba(219,112,147,0.1)',
      'text_color' => 'rgba(255,20,147,0.2)',
      'link_color' => 'rgba(255,102,170,0.3)',
      'h_background_color' => 'rgba(219,112,147,0.4)',
      'h_link_color' => 'rgba(255,20,147,0.5)',
      'h_text_color' => 'rgba(255,102,170,0.6)',
      'transition_duration' => '1',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background-color:rgba(219,112,147,0.1)',
          'color:rgba(255,20,147,0.2)',
          'transition-duration:1s',
        ],
        '.selector a' => [
          'color:rgba(255,102,170,0.3)',
          'transition-duration:1s',
        ],
        '.selector:hover' => [
          'background-color:rgba(219,112,147,0.4)',
          'color:rgba(255,102,170,0.6)',
          'transition-duration:1s',
        ],
        '.selector a:hover' => [
          'color:rgba(255,20,147,0.5)',
          'transition-duration:1s',
        ],
      ],
    ];
    $expected_attributes_2 = [
      'class' => [
        'modifiers-has-background',
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEmpty($actual_2->getLibraries());
    $this->assertEmpty($actual_2->getSettings());
    $this->assertEquals($expected_attributes_2, $actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
