<?php

namespace Drupal\my_event\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\my_event\Event\NodeDeleteDemoEvent;

/**
 * Logs the creation of a new node.
 */
class NodeDeleteDemoSubscriber implements EventSubscriberInterface {

  /**
   * Log the creation of a new node.
   *
   * @param \Drupal\my_event\Event\NodeDeleteDemoEvent $event
   */
  public function onDemoNodeDelete(NodeDeleteDemoEvent $event) {
    $entity = $event->getEntity();
    \Drupal::logger('my_event')->notice('New @type: @title. Deleted by: @owner. userid: @uid. Body: @body. NID: @nid',
      array(
        '@type' => $entity->getType(),
        '@title' => $entity->label(),
        '@owner' => $entity->getOwner()->getDisplayName(),
        '@uid' => $entity->getOwnerId(),
        '@body' => $entity->get('body')->value,
        '@nid' => $entity->get('nid')->value,
        ));
        // dd($entity);
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[NodeDeleteDemoEvent::DEMO_NODE_DELETE][] = ['onDemoNodeDelete'];
    return $events;
  }
}
