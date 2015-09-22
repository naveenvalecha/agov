<?php
/**
 * @file
 * Defines the home panel layout
 * @copyright Copyright(c) 2012 Previous Next Pty Ltd
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 */

/**
 * Implementation of hook_panels_layouts().
 */
$plugin = array(
  'title' => t('Home Layout'),
  'category' => t('aGov Whitlam'),
  'icon' => 'home.png',
  'theme' => 'agov_layouts_home',
  'regions' => array(
    'header' => t('Header region'),
    'promo-1' => t('Promo region 1'),
    'promo-2' => t('Promo region 2'),
    'promo-3' => t('Promo region 3'),
    'main' => t('Main region'),
    'right-sidebar' => t('Right sidebar region'),
    'footer-1' => t('Footer region 1'),
    'footer-2' => t('Footer region 2'),
    'footer-3' => t('Footer region 3'),
  ),
);
