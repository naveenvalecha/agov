<?php

/**
 * @file
 * Contains \Drupal\agov\Tests\DefaultContentTest.
 */

namespace Drupal\agov\Tests;

/**
 * Test the default content.
 *
 * @group agov
 */
class DefaultContentTest extends AgovTestBase {

  /**
   * An array of modules to be installed.
   *
   * @var array
   */
  public static $modules = ['agov_default_content'];

  /**
   * Test various default content placements.
   */
  public function testDefaultContent() {
    // Homepage.
    $this->drupalGet('<front>');

    // Assert discover aGov block.
    $this->assertEqual('Discover aGov', $this->cssSelect('.region-featured-top .button')[0]);

    // Assert three promo blocks.
    $this->assertEqual('Integer lacinia ullamcorper tempor', $this->cssSelect('.block-region-promo-1 .teaser__title a')[0]);
    $this->assertEqual('Suspendisse id elit arcu.', $this->cssSelect('.block-region-promo-2 .teaser__title a')[0]);
    $this->assertEqual('Nam eget placerat sapien', $this->cssSelect('.block-region-promo-3 .teaser__title a')[0]);

    // Assert latest updates.
    $this->assertEqual('Latest Updates', $this->cssSelect('.block-views-blocklatest-updates-block-1 h2')[0]);

    // Assert Twitter feed.
    $this->assertEqual('Twitter feed', $this->cssSelect('.block-twitter-block h2')[0]);

    // Assert Quicklinks.
    $this->assertEqual('Quick Links', $this->cssSelect('.menu--quick-links h2')[0]);

    // Assert stay up-to-date block.
    $this->assertText('Stay up to date');

    // Assert icon blocks.
    $this->assertEqual('Cras accumsan fringilla', $this->cssSelect('.block-region-footer-1 .box__title a')[0]);
    $this->assertEqual('Duis id consequat ipsum', $this->cssSelect('.block-region-footer-2 .box__title a')[0]);
    $this->assertEqual('Nunc pulvinar venenatis', $this->cssSelect('.block-region-footer-3 .box__title a')[0]);

    // Assert footer menus.
    $this->assertEqual('Quick Links', $this->cssSelect('#block-footerquicklinks h2')[0]);
    $this->assertEqual('Site map', $this->cssSelect('#block-mainnavigation-3 h2')[0]);

    // Test the breadcrumbs.
    $this->drupalGet('/publications');
    $breadcrumb = $this->cssSelect('.breadcrumb__list');
    $this->assertEqual('Home', (string) $breadcrumb[0]->li[0]->a);
    $this->assertEqual('Publications', (string) trim($breadcrumb[0]->li[1]));

    // Assert breadcrumb on individual publication page.
    $this->drupalGet('/publications/saluto-vicis');
    $breadcrumb = $this->cssSelect('.breadcrumb__list');
    $this->assertEqual('Home', (string) $breadcrumb[0]->li[0]->a);
    $this->assertEqual('Publications', (string) $breadcrumb[0]->li[1]->a);
    $this->assertEqual('Saluto Vicis', (string) trim($breadcrumb[0]->li[2]));

    // Assert the sub-menu only appears on the /resources page.
    $this->drupalGet('/resources');
    $this->assertRaw('block-mainnavigation-2');
    $this->drupalGet('/about-us');
    $this->assertNoRaw('block-mainnavigation-2');
  }

}
