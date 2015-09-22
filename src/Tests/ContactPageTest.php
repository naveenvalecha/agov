<?php

/**
 * @file
 * Contains \Drupal\agov\Tests\ContactPageTest.
 */

namespace Drupal\agov\Tests;

use Symfony\Component\BrowserKit\Request;

/**
 * Test the contact page.
 *
 * @group agov
 */
class ContactPageTest extends AgovTestBase {

  /**
   * The admin user.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    $this->adminUser = $this->drupalCreateUser([]);
  }

  /**
   * Test we're on the configurable dependencies.
   */
  public function testContactPage() {
    // Anonymous users can view the contact page and get the name fields.
    $this->drupalGet('/contact');
    $this->assertResponse(200);
    $this->assertFieldById('edit-message-0-value');

    // Authenticated users get the form as well.
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('/contact');
    $this->assertResponse(200);
    $this->assertFieldById('edit-message-0-value');
  }

}
