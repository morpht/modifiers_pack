<?php

namespace Drupal\Tests\modifiers_relative_height\Unit;

use Drupal\modifiers_relative_height\Plugin\modifiers\RelativeHeightModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_relative_height\Plugin\modifiers\RelativeHeightModifier
 * @group modifiers_pack
 */
class RelativeHeightModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Vertical align is empty.
    $actual_1 = RelativeHeightModifier::modification('.selector', [
      'relative_height' => '1.500',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'overflow:hidden',
        ],
      ],
    ];
    $expected_libraries_1 = [
      'modifiers_relative_height/apply',
    ];
    $expected_settings_1 = [
      'namespace' => 'RelativeHeightModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
      'args' => [
        'ratio' => '1.500',
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEquals($expected_libraries_1, $actual_1->getLibraries());
    $this->assertEquals($expected_settings_1, $actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Vertical align is not empty.
    $actual_2 = RelativeHeightModifier::modification('.selector', [
      'relative_height' => '1.500',
      'vertical_align' => 'top',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'display:flex',
          'align-items:flex-start',
          'overflow:hidden',
        ],
      ],
    ];
    $expected_libraries_2 = [
      'modifiers_relative_height/apply',
    ];
    $expected_settings_2 = [
      'namespace' => 'RelativeHeightModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
      'args' => [
        'ratio' => '1.500',
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEquals($expected_libraries_2, $actual_2->getLibraries());
    $this->assertEquals($expected_settings_2, $actual_2->getSettings());
    $this->assertEmpty($actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
