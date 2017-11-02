<?php

namespace Drupal\Tests\modifiers_html_font_size\Unit;

use Drupal\modifiers_html_font_size\Plugin\modifiers\HtmlFontSizeModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_html_font_size\Plugin\modifiers\HtmlFontSizeModifier
 * @group modifiers_pack
 */
class HtmlFontSizeModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Font size is empty.
    $actual_1 = HtmlFontSizeModifier::modification('.selector', []);
    $this->assertEmpty($actual_1);

    // Font size is not empty.
    $actual_2 = HtmlFontSizeModifier::modification('.selector', [
      'fonts_base_size' => '14px',
    ]);
    $expected_css_2 = [
      'all' => [
        '.selector' => [
          'font-size:14px!important',
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
