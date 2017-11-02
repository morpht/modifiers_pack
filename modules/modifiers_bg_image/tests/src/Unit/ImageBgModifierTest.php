<?php

namespace Drupal\Tests\modifiers_bg_image\Unit;

use Drupal\modifiers_bg_image\Plugin\modifiers\ImageBgModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_bg_image\Plugin\modifiers\ImageBgModifier
 * @group modifiers_pack
 */
class ImageBgModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Image style is empty.
    $actual_1 = ImageBgModifier::modification('.selector', [
      'image' => '/image-path',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'background-image:url("/image-path")',
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

    // Image style is not empty.
    $actual_2 = ImageBgModifier::modification('.selector', [
      'image' => '/image-path',
      'image_style' => 'repeat-x',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'background-image:url("/image-path")',
          'background-repeat:repeat-x',
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
