<?php

namespace Drupal\Tests\modifiers_hide\Unit;

use Drupal\modifiers_hide\Plugin\modifiers\HideModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_hide\Plugin\modifiers\HideModifier
 * @group modifiers_pack
 */
class HideModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Well-formed boolean value.
    $actual_1 = HideModifier::modification('.selector', [
      'hide' => '1',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'display:none',
        ],
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEmpty($actual_1->getLibraries());
    $this->assertEmpty($actual_1->getSettings());
    $this->assertEmpty($actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Mall-formed boolean value.
    $actual_2 = HideModifier::modification('.selector', [
      'hide' => '2',
    ]);
    $this->assertEmpty($actual_2);
  }

}
