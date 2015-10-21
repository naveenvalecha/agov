<?php

/**
 * @file
 * Contains \Drupal\KernelTests\Config\DefaultConfigTest.
 */

namespace Drupal\Tests\agov\Kernel;

use Drupal\Core\Config\FileStorage;
use Drupal\Core\Config\InstallStorage;
use Drupal\Core\Config\StorageInterface;
use Drupal\Core\Site\Settings;
use Drupal\KernelTests\AssertConfigTrait;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests that the installed config matches the default config.
 *
 * @group agov
 */
class DefaultConfigTest extends KernelTestBase {

  use AssertConfigTrait;

  public static $modules = [
    'system',
    'user',
    'node',
    'field',
    'history',
    'block',
    'breakpoint',
    'ckeditor',
    'color',
    'config',
    'comment',
    'contextual',
    'text',
    'contact',
    'menu_link_content',
    'datetime',
    'block_content',
    'quickedit',
    'editor',
    'entity_reference',
    'help',
    'image',
    'menu_ui',
    'options',
    'path',
    'page_cache',
    'taxonomy',
    'search',
    'shortcut',
    'toolbar',
    'field_ui',
    'file',
    'filter',
    'rdf',
    'views',
    'views_ui',
    'tour',
    'link',

    'fences',
    'file_entity',
    'twitter_block',
    'layout_plugin',
    'page_manager',
    'pathauto',
    'token',
    'title',
    'text_icon',
  ];

  /**
   * An array of config objects not to validate.
   *
   * @var array
   */
  protected $skippedConfig = [
    // @TODO figure out what in the installer is allowing config file overrides
    // and why that doesn't work in KTB?
    'node.settings' => TRUE,
    'system.theme' => TRUE,
  ];

  /**
   * Modules that we don't want to validate the config for. Should be none.
   *
   * @var array
   */
  protected $excludedModules = [
    // This causes many issues when installed with KTB so ignore it.
    'agov_default_content',
    // @TODO, move to contrib.
    'text_icon',
  ];

  /**
   * The name of the profile.
   *
   * @var string
   */
  protected $profile = 'agov';

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // @todo ModuleInstaller calls system_rebuild_module_data which is part of
    //   system.module, see https://www.drupal.org/node/2208429.
    include_once $this->root . '/core/modules/system/system.module';

    // We must set agov as the active profile so that we can install its default
    // config below.
    $old_settings = Settings::getAll();
    new Settings(['install_profile' => $this->profile] + $old_settings);

    // Set up the state values so we know where to find the files when running
    // drupal_get_filename().
    // @todo Remove as part of https://www.drupal.org/node/2186491
    system_rebuild_module_data();

    // Install the required schema and config for core modules.
    $this->installSchema('system', 'router');
    $this->installEntitySchema('block_content');
    $this->installEntitySchema('block_content_type');
    $this->installEntitySchema('file');
    $this->installConfig(['node', 'block_content', 'system']);

    // Install the default config for our installation profile.
    $this->container->get('config.installer')->installDefaultConfig('profile', $this->profile);
  }

  /**
   * Test the configuration for the profile specifically.
   */
  public function testProfileConfig() {
    $default_install_path = drupal_get_path('profile', $this->profile) . '/' . InstallStorage::CONFIG_INSTALL_DIRECTORY;
    $this->assertConfig($default_install_path);
  }

  /**
   * Tests if installed config is equal to the exported config.
   *
   * @dataProvider providerTestModuleConfig
   */
  public function testModuleConfig($module) {
    $this->container->get('module_installer')
      ->install([$module]);

    $default_install_path = drupal_get_path('module', $module) . '/' . InstallStorage::CONFIG_INSTALL_DIRECTORY;
    $this->assertConfig($default_install_path);
  }

  /**
   * Assert the configuration is the same as the installed config.
   *
   * @param string $default_install_path
   *   The full path to the install directory of the extension.
   *
   * @throws \Exception
   */
  protected function assertConfig($default_install_path) {
    $module_config_storage = new FileStorage($default_install_path, StorageInterface::DEFAULT_COLLECTION);

    // Compare the installed config with the one in the module directory.
    foreach ($module_config_storage->listAll() as $config_name) {
      $result = $this->container->get('config.manager')
        ->diff($module_config_storage, $this->container->get('config.storage'), $config_name);
      $this->assertConfigDiff($result, $config_name, $this->skippedConfig);
    }
  }

  /**
   * Test data provider for ::testModuleConfig().
   *
   * @return array
   *   An array of module names to test.
   */
  public function providerTestModuleConfig() {
    $module_dirs = array_keys(iterator_to_array(new \FilesystemIterator(__DIR__ . '/../../../modules/custom/')));
    $module_names = array_map(function($path) {
      return str_replace(__DIR__ . '/../../../modules/custom/', '', $path);
    }, $module_dirs);

    $modules = [];
    foreach ($module_names as $module) {
      $modules[$module] = [$module];
    }
    return array_diff_key($modules, array_flip($this->excludedModules));
  }

}
