<?php

namespace Drupal\Tests\modifiers_radial_gradient\Unit;

use Drupal\modifiers_radial_gradient\Plugin\modifiers\RadialGradientModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_radial_gradient\Plugin\modifiers\RadialGradientModifier
 * @group modifiers_pack
 */
class RadialGradientModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Gradient has only one color.
    $actual_1 = RadialGradientModifier::modification('.selector', [
      'r_gradient_colors' => [
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
    $actual_2 = RadialGradientModifier::modification('.selector', [
      'r_gradient_colors' => [
        'rgba(219,112,147,0.1)',
        'rgba(255,20,147,0.2)',
      ],
      'r_gradient_position' => ['40.00', '60.00'],
      'r_gradient_shape' => 'ellipse',
      'r_gradient_size' => 'farthest-corner',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background:radial-gradient(ellipse farthest-corner at 40.00% 60.00%,rgba(219,112,147,0.1),rgba(255,20,147,0.2))',
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
