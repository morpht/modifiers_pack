<?php

namespace Drupal\Tests\modifiers_bg_parallax\Unit;

use Drupal\modifiers_bg_parallax\Plugin\modifiers\ParallaxBgModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_bg_parallax\Plugin\modifiers\ParallaxBgModifier
 * @group modifiers_pack
 */
class ParallaxBgModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Parallax speed is empty.
    $actual_1 = ParallaxBgModifier::modification('.selector', [
      'parallax' => '/image-path',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'background-image:url("/image-path")',
        ],
      ],
    ];
    $expected_libraries_1 = [
      'modifiers_bg_parallax/parallax',
      'modifiers_bg_parallax/apply',
    ];
    $expected_settings_1 = [
      'namespace' => 'ParallaxBgModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
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
    $this->assertEquals($expected_libraries_1, $actual_1->getLibraries());
    $this->assertEquals($expected_settings_1, $actual_1->getSettings());
    $this->assertEquals($expected_attributes_1, $actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Parallax speed is not empty.
    $actual_2 = ParallaxBgModifier::modification('.selector', [
      'parallax' => '/image-path',
      'parallax_speed' => '0.5',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background-image:url("/image-path")',
        ],
      ],
    ];
    $expected_libraries_2 = [
      'modifiers_bg_parallax/parallax',
      'modifiers_bg_parallax/apply',
    ];
    $expected_settings_2 = [
      'namespace' => 'ParallaxBgModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
      'args' => [
        'speed' => '0.5',
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
    $this->assertEquals($expected_libraries_2, $actual_2->getLibraries());
    $this->assertEquals($expected_settings_2, $actual_2->getSettings());
    $this->assertEquals($expected_attributes_2, $actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
