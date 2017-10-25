<?php

namespace Drupal\Tests\modifiers_bg_video\Unit;

use Drupal\modifiers_bg_video\Plugin\modifiers\VideoBgModifier;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\modifiers_bg_video\Plugin\modifiers\VideoBgModifier
 * @group modifiers_pack
 */
class VideoBgModifierTest extends UnitTestCase {

  /**
   * @covers ::modification
   */
  public function testModification() {
    // Well-formed video URL.
    $actual_1 = VideoBgModifier::modification('.selector', [
      'video' => 'youtube:https://www.youtube.com/watch?v=video-code',
    ]);
    $expected_css_1 = [
      'all' => [
        '.selector' => [
          'position:relative',
        ],
        '.selector .videojs-background-wrap' => [
          'position:absolute;overflow:hidden;width:100%;height:100%;top:0;left:0;z-index:-998',
        ],
      ],
    ];
    $expected_libraries_1 = [
      'modifiers_bg_video/videojs',
      'modifiers_bg_video/videojs_background',
      'modifiers_bg_video/apply',
      'modifiers_bg_video/videojs_youtube',
    ];
    $expected_settings_1 = [
      'namespace' => 'VideoBgModifier',
      'callback' => 'apply',
      'selector' => '.selector',
      'media' => 'all',
      'args' => [
        'provider' => 'youtube',
        'video' => 'video-code',
      ],
    ];
    $expected_attributes_1 = [
      'class' => [
        'modifiers-has-background',
      ],
    ];
    $this->assertEquals($expected_css_1, $actual_1->getCss());
    $this->assertEquals($expected_libraries_1, $actual_1->getLibraries());
    $this->assertEquals($expected_settings_1, $actual_1->getSettings());
    $this->assertEquals($expected_attributes_1, $actual_1->getAttributes());
    $this->assertEmpty($actual_1->getLinks());

    // Mall-formed video URL.
    $actual_2 = VideoBgModifier::modification('.selector', [
      'video' => 'https://www.other-service.com/watch?v=video-code',
    ]);
    $this->assertEmpty($actual_2);
  }

}
