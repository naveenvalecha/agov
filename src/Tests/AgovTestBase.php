<?php

/**
 * @file
 * Contains \Drupal\agov\Tests\AgovTestBase.
 */

namespace Drupal\agov\Tests;

use Drupal\simpletest\WebTestBase;
use Symfony\Component\BrowserKit\Request;

/**
 * Base class for testing aGov.
 *
 * @group agov
 */
abstract class AgovTestBase extends WebTestBase {

  /**
   * Override the installation profile to our testing profile.
   *
   * @var string
   */
  protected $profile = 'agov';

}
