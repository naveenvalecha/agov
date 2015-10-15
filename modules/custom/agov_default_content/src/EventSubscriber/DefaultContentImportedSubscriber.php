<?php

/**
 * @file
 * Drupal\agov_default_content\EventSubscriber\DefaultContentImportedSubscriber.
 */

namespace Drupal\agov_default_content\EventSubscriber;

use Drupal\default_content\Event\DefaultContentEvents;
use Drupal\default_content\Event\ImportEvent;
use Drupal\menu_link_content\Entity\MenuLinkContent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscribes to the default content imported event.
 */
class DefaultContentImportedSubscriber implements EventSubscriberInterface {

  /**
   * Process the imported entities so we can add the appropriate menu links.
   *
   * @param \Drupal\default_content\Event\ImportEvent $event
   *   The import event.
   */
  public function processImportedEntities(ImportEvent $event) {

    // We only care about creating menu links for our own content.
    if ($event->getModule() !== 'agov_default_content') {
      return;
    }

    // Create out static links, maybe we shouldn't do this always?
    $this->createMenuLink('Home', 'internal:/<front>', -2);
    $this->createMenuLink('Contact', 'internal:/contact', 10);

    $entities = $event->getImportedEntities();
    $map = [
      '3b2e357b-0a96-4371-af02-02a17cc0e41f' => 'About Us',
      '6eb572d1-dd76-4944-9f00-0dda6e0874d9' => 'Services',
      '78eff650-8399-4c62-b92c-445de219a47d' => 'Resources',
    ];
    $weight = 0;
    foreach ($map as $uuid => $text) {
      if (isset($entities[$uuid])) {
        $this->createMenuLink($text, 'entity:node/' . $entities[$uuid]->id(), $weight++);
      }
    }

    $this->createFooterQuickLinks();
  }

  /**
   * Create default links for the footer.
   */
  protected function createFooterQuickLinks() {
    $link_labels = [
      'A fortiori argument',
      'Ceteris paribus',
      'De dicto and de re',
      'Eo ipso',
      'Ignotum per ignotius',
      'Modus ponendo tollens',
      'Non causa pro causa',
      'Per fas et nefas',
      'Q.E.D.',
      'Reductio ad absurdum',
      'Salva congruitate',
    ];
    $weight = 0;
    foreach ($link_labels as $link_label) {
      $this->createMenuLink($link_label, 'internal:/<front>', $weight, 'footer-quick-links');
      $weight++;
    }
  }

  /**
   * Creates a menu link given text and path.
   *
   * @param string $text
   *   The menu link text.
   * @param string $path
   *   The menu link path.
   * @param int $weight
   *   The menu link weight.
   */
  protected function createMenuLink($text, $path, $weight = 0, $menu = 'main') {
    MenuLinkContent::create([
      'title' => $text,
      'link' => ['uri' => $path],
      'menu_name' => $menu,
      'weight' => $weight,
    ])->save();
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[DefaultContentEvents::IMPORT][] = ['processImportedEntities'];

    return $events;
  }

}
