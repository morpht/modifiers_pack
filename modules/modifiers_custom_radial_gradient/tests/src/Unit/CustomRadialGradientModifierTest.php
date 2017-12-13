<?php

namespace Drupal\Tests\modifiers_custom_radial_gradient\Unit;

use Drupal\modifiers_custom_radial_gradient\Plugin\modifiers\CustomRadialGradientModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_custom_radial_gradient\Plugin\modifiers\CustomRadialGradientModifier
 * @group modifiers_pack
 */
class CustomRadialGradientModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Gradient has only one color.
    $actual_1 = CustomRadialGradientModifier::modification('.selector', [
      'cr_gradient_colors' => [
        'rgba(219,112,147,0.1)',
      ],
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'background:rgba(219,112,147,0.1)',
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

    // Gradient has position, shape and size.
    $actual_2 = CustomRadialGradientModifier::modification('.selector', [
      'cr_gradient_colors' => [
        'rgba(219,112,147,0.1)',
        'rgba(255,20,147,0.2)',
      ],
      'cr_gradient_position' => [0 => '50.00', 1 => '50.00'],
      'cr_gradient_shape' => 'ellipse',
      'cr_gradient_size' => 'farthest-corner',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background:radial-gradient(ellipse farthest-corner at 50.00% 50.00%, rgba(219,112,147,0.1),rgba(255,20,147,0.2))',
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
