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
 */
abstract class AgovTestBase extends WebTestBase {

  /**
   * Disable strict config checking.
   *
   * Right now we can't enable strict config checking because of how page
   * manager interacts with: https://www.drupal.org/node/2392057.
   *
   * @var bool
   */
  protected $strictConfigSchema = FALSE;

  /**
   * Override the installation profile to our testing profile.
   *
   * @var string
   */
  protected $profile = 'agov';

}
