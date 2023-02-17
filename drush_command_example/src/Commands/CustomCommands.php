<?php
namespace Drupal\drush_command_example\Commands;
use Drush\Commands\DrushCommands;


/**
 * Drush command file.
 */
class CustomCommands extends DrushCommands {
  /**
   *  Entity type service.
   * @var \DrupalCore\Entity\EntityTypeManagerInterface
   */

  /**
   * A custom Drush command to displays the given text.
   * 
   * @command custom:message
   * @aliases custom-message
   * @param string $message is the user input string
   * @option arr An option that takes multiple values.
   * @options count to return count of the string.
   */
  public function printMessage($message, $options = ['count' => FALSE]) {
    if ($options['count']) {

    $this->output()->writeln('the given string character count is ' . strlen($message));
  }
  else{
    $this->output()->writeln('The messsage: ' . $message);
  }
  }
}