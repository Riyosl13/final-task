<?php

namespace Drupal\mymigrate\EventSubscriber;

use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigrateImportEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class PreMigrationSubscriber.
 *
 * Run a test to validate that the server is available.
 *
 * @package Drupal\YOUR_MODULE
 */
class mymigrateMigrationSubscriber implements EventSubscriberInterface {

  /**
   * Get subscribed events.
   *
   * @inheritdoc
   */
  public static function getSubscribedEvents() {
    $events[MigrateEvents::PRE_IMPORT][] = ['onMigratePreImport'];
    $events[MigrateEvents::POST_IMPORT][] = ['onMigratePostImport'];
    return $events;
  }

  /**
   * Check for the image server status just once to avoid thousands of requests.
   *
   * @param \Drupal\migrate\Event\MigrateImportEvent $event
   *   The import event object.
   */
  public function onMigratePreImport(MigrateImportEvent $event) {
    $migration_id = $event->getMigration()->getBaseId();

    if (strpos($migration_id, '_products', -9)) {
      $store = \Drupal::service('tempstore.private')->get('my_module_migrations');

      if ($this->checkImageServerStatus('https://www.TESTDOMAIN.com')) {
        $store->set('server_available', TRUE);
      }
      else {
        $store->set('server_available', FALSE);
        $event->logMessage('The server is unreachable.');
      }
    }
  }

  /**
   * Checks the status of the image server.
   *
   * @param string $url
   *   The URL to check.
   *
   * @return bool
   *   TRUE if the image server is available, FALSE otherwise.
   */
  private function checkImageServerStatus($url) {
    $headers = @get_headers($url);

    // Use condition to check the existence of URL.
    if ($headers && strpos($headers[0], '200')) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Check for our specified last node migration and run our flagging mechanisms.
   *
   * @param \Drupal\migrate\Event\MigrateImportEvent $event
   *   The import event object.
   */
  public function onMigratePostImport(MigrateImportEvent $event) {
    $migration_id = $event->getMigration()->getBaseId();

    // Do a little bit of cleanup.
    if (strpos($migration_id, '_products', -9)) {
      $store = \Drupal::service('tempstore.private')->get('my_module_migrations');
      $store->delete('server_available');
    }
  }

}