<?php

/**
 * @file
 * Contains \Drupal\agov\EventSubscriber\Agov4032404Subscriber.
 */

namespace Drupal\agov\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Agov mode subscriber for controller requests.
 */
class Agov4032404Subscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public function on403(GetResponseForExceptionEvent $event) {
    $event->setException(new NotFoundHttpException());
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::EXCEPTION][] = ['on403'];
    return $events;
  }

}
