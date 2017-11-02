<?php

namespace Drupal\Tests\modifiers_image_fx\Unit;

use Drupal\modifiers_image_fx\Plugin\modifiers\ImageFxModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_image_fx\Plugin\modifiers\ImageFxModifier
 * @group modifiers_pack
 */
class ImageFxModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Effects without hover.
    $actual_1 = ImageFxModifier::modification('.selector', [
      'image_fx_blur' => '1',
      'image_fx_brightness' => '2',
      'image_fx_contrast' => '3',
      'image_fx_hue_rotate' => '4',
      'image_fx_invert' => '5',
      'image_fx_grayscale' => '6',
      'image_fx_saturate' => '7',
      'image_fx_sepia' => '8',
      'image_fx_opacity' => '9',
      'image_fx_scale' => '10',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector img' => [
          'filter:blur(1px)',
          'filter:brightness(2%)',
          'filter:contrast(3%)',
          'filter:hue-rotate(4deg)',
          'filter:invert(5%)',
          'filter:grayscale(6%)',
          'filter:saturate(7%)',
          'filter:sepia(8%)',
          'filter:opacity(9%)',
          'transform:scale(10)',
          '-webkit-transform:translateZ(0)',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Effects on hover.
    $actual_2 = ImageFxModifier::modification('.selector', [
      'image_fx_h_blur' => '1',
      'image_fx_h_brightness' => '2',
      'image_fx_h_contrast' => '3',
      'image_fx_h_hue_rotate' => '4',
      'image_fx_h_invert' => '5',
      'image_fx_h_grayscale' => '6',
      'image_fx_h_saturate' => '7',
      'image_fx_h_sepia' => '8',
      'image_fx_h_opacity' => '9',
      'image_fx_h_scale' => '10',
      'image_fx_duration' => '1',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector:hover img' => [
          'filter:blur(1px)',
          'filter:brightness(2%)',
          'filter:contrast(3%)',
          'filter:hue-rotate(4deg)',
          'filter:invert(5%)',
          'filter:grayscale(6%)',
          'filter:saturate(7%)',
          'filter:sepia(8%)',
          'filter:opacity(9%)',
          'transform:scale(10)',
        ],
        '.selector img' => [
          'transition-duration:1s',
          '-webkit-transform:translateZ(0)',
        ],
      ],
    ];
    $this->assertEquals($expected_css_2, $actual_2->getCss());
    $this->assertEmpty($actual_2->getLibraries());
    $this->assertEmpty($actual_2->getSettings());
    $this->assertEmpty($actual_2->getAttributes());
    $this->assertEmpty($actual_2->getLinks());
  }

}
