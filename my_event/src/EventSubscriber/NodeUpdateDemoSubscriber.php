<?php

namespace Drupal\my_event\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\my_event\Event\NodeUpdateDemoEvent;

/**
 * Logs the creation of a new node.
 */
class NodeUpdateDemoSubscriber implements EventSubscriberInterface {

  /**
   * Log the creation of a new node.
   *
   * @param \Drupal\my_event\Event\NodeUpdateDemoEvent $event
   */
  public function onDemoNodeUpdate(NodeUpdateDemoEvent $event) {
    $entity = $event->getEntity();
    \Drupal::logger('my_event')->notice('New @type: @title. Updated by: @owner. userid: @uid. Body: @body. NID: @nid',
      array(
        '@type' => $entity->getType(),
        '@title' => $entity->label(),
        '@owner' => $entity->getOwner()->getDisplayName(),
        '@uid' => $entity->getOwnerId(),
        '@body' => $entity->get('body')->value,
        '@nid' => $entity->get('nid')->value,
        ));
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[NodeUpdateDemoEvent::DEMO_NODE_UPDATE][] = ['onDemoNodeUpdate'];
    return $events;
  }
}