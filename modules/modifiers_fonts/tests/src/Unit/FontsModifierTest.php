<?php

namespace Drupal\Tests\modifiers_fonts\Unit;

use Drupal\modifiers_fonts\Plugin\modifiers\FontsModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_fonts\Plugin\modifiers\FontsModifier
 * @group modifiers_pack
 */
class FontsModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Fonts stylesheets are empty.
    $actual_1 = FontsModifier::modification('.selector', [
      'fonts_base' => 'normal 300 1.0rem/2.0rem sans-serif',
      'fonts_h1' => 'normal 300 1.6rem/2.0rem sans-serif',
      'fonts_h2' => 'normal 300 1.5rem/2.0rem sans-serif',
      'fonts_h3' => 'normal 300 1.4rem/2.0rem sans-serif',
      'fonts_h4' => 'normal 300 1.3rem/2.0rem sans-serif',
      'fonts_h5' => 'normal 300 1.2rem/2.0rem sans-serif',
      'fonts_h6' => 'normal 300 1.1rem/2.0rem sans-serif',
      'fonts_em' => 'italic 300 1.0rem/2.0rem sans-serif',
      'fonts_strong' => 'normal 600 1.0rem/2.0rem sans-serif',
      'fonts_h1_transform' => 'none',
      'fonts_h2_transform' => 'uppercase',
      'fonts_h3_transform' => 'lowercase',
      'fonts_h4_transform' => 'capitalize',
      'fonts_h5_transform' => 'none',
      'fonts_h6_transform' => 'uppercase',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'font:normal 300 1.0rem/2.0rem sans-serif',
        ],
        '.selector h1' => [
          'font:normal 300 1.6rem/2.0rem sans-serif',
          'text-transform:none',
        ],
        '.selector h2' => [
          'font:normal 300 1.5rem/2.0rem sans-serif',
          'text-transform:uppercase',
        ],
        '.selector h3' => [
          'font:normal 300 1.4rem/2.0rem sans-serif',
          'text-transform:lowercase',
        ],
        '.selector h4' => [
          'font:normal 300 1.3rem/2.0rem sans-serif',
          'text-transform:capitalize',
        ],
        '.selector h5' => [
          'font:normal 300 1.2rem/2.0rem sans-serif',
          'text-transform:none',
        ],
        '.selector h6' => [
          'font:normal 300 1.1rem/2.0rem sans-serif',
          'text-transform:uppercase',
        ],
        '.selector em' => [
          'font:italic 300 1.0rem/2.0rem sans-serif',
        ],
        '.selector strong' => [
          'font:normal 600 1.0rem/2.0rem sans-serif',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Fonts stylesheets are not empty.
    $actual_2 = FontsModifier::modification('.selector', [
      'fonts_stylesheets' => [
        'https://fonts.googleapis.com/css?family=Font+1+Name',
        'https://fonts.googleapis.com/css?family=Font+2+Name',
      ],
    ]);
    $expected_links_2 = [
      [
        'href' => 'https://fonts.googleapis.com/css?family=Font+1+Name',
        'rel' => 'stylesheet',
      ],
      [
        'href' => 'https://fonts.googleapis.com/css?family=Font+2+Name',
        'rel' => 'stylesheet',
      ],
    ];
    $this->assertEmpty($actual_2->getCss());
    $this->assertEmpty($actual_2->getLibraries());
    $this->assertEmpty($actual_2->getSettings());
    $this->assertEmpty($actual_2->getAttributes());
    $this->assertEquals($expected_links_2, $actual_2->getLinks());
  }

}
