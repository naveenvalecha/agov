<?php

/**
 * @file
 * Contains \Drupal\agov\Tests\SearchTest.
 */

namespace Drupal\agov\Tests;

/**
 * Test the search box.
 *
 * @group agov
 */
class SearchTest extends AgovTestBase {

  /**
   * An authenticated user.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $authenticatedUser;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    $this->authenticatedUser = $this->drupalCreateUser();
  }

  /**
   * Test the search-box in the header works.
   */
  public function testSearchBox() {
    // Test the search box appears on the homepage and the search page appears.
    $this->drupalGet('<front>');
    $this->assertFieldById('edit-keys', '', 'Search box exists');
    $this->drupalGet('/search/node', ['query' => ['keys' => 'about']]);
    $this->assertText('Search for about');

    // Create some content and assert it appears when searched.
    $node1 = $this->drupalCreateNode(['type' => 'standard_page']);
    $node2 = $this->drupalCreateNode(['type' => 'standard_page']);
    $this->cronRun();

    // Assert the two nodes can be found.
    $this->drupalGet('/search/node', ['query' => ['keys' => $node1->label()]]);
    $this->assertEqual($node1->label(), (string) $this->cssSelect('.search-result__title a')[0]);
    $this->drupalGet('/search/node', ['query' => ['keys' => $node2->label()]]);
    $this->assertEqual($node2->label(), (string) $this->cssSelect('.search-result__title a')[0]);

    // Login and make sure the search still works.
    $this->drupalLogin($this->authenticatedUser);
    $this->drupalGet('/search/node', ['query' => ['keys' => $node1->label()]]);
    $this->assertEqual($node1->label(), (string) $this->cssSelect('.search-result__title a')[0]);
    $this->drupalGet('/search/node', ['query' => ['keys' => $node2->label()]]);
    $this->assertEqual($node2->label(), (string) $this->cssSelect('.search-result__title a')[0]);
  }

}
