<?php

namespace Drupal\Tests\modifiers_linear_gradient\Unit;

use Drupal\modifiers_linear_gradient\Plugin\modifiers\LinearGradientModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_linear_gradient\Plugin\modifiers\LinearGradientModifier
 * @group modifiers_pack
 */
class LinearGradientModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Gradient direction is empty.
    $actual_1 = LinearGradientModifier::modification('.selector', [
      'l_gradient_colors' => [
        'rgba(219,112,147,0.1)',
        'rgba(255,20,147,0.2)',
      ],
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'background:linear-gradient(rgba(219,112,147,0.1),rgba(255,20,147,0.2))',
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

    // Gradient direction is not empty.
    $actual_2 = LinearGradientModifier::modification('.selector', [
      'l_gradient_colors' => [
        'rgba(219,112,147,0.1)',
        'rgba(255,20,147,0.2)',
      ],
      'l_gradient_direction' => '90',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background:linear-gradient(90deg,rgba(219,112,147,0.1),rgba(255,20,147,0.2))',
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
