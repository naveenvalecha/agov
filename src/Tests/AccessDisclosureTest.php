<?php

/**
 * @file
 * Contains \Drupal\agov\Tests\AccessDisclosureTest.
 */

namespace Drupal\agov\Tests;

/**
 * Test access disclosure for admin pages.
 *
 * @group agov
 */
class AccessDisclosureTest extends AgovTestBase {

  /**
   * Prevent disclosure of access denied pages by returning a 404 response.
   */
  public function testAdminPage404() {
    $this->drupalGet('/admin');
    $this->assertResponse(404);
  }

}
