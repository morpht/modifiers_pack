<?php

namespace Drupal\Tests\modifiers_custom_linear_gradient\Unit;

use Drupal\modifiers_custom_linear_gradient\Plugin\modifiers\CustomLinearGradientModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_custom_linear_gradient\Plugin\modifiers\CustomLinearGradientModifier
 * @group modifiers_pack
 */
class CustomLinearGradientModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Custom gradient direction is empty.
    $actual_1 = CustomLinearGradientModifier::modification('.selector', [
      'cl_gradient_colors' => [
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
      'class' => [
        'modifiers-has-background',
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEquals($expected_attributes_1, $actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Custom gradient direction is not empty.
    $actual_2 = CustomLinearGradientModifier::modification('.selector', [
      'cl_gradient_colors' => [
        'rgba(219,112,147,0.1)',
        'rgba(255,20,147,0.2)',
      ],
      'cl_gradient_direction' => '90',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background:linear-gradient(90deg,rgba(219,112,147,0.1),rgba(255,20,147,0.2))',
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
