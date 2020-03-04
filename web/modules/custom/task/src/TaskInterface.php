<?php

namespace Drupal\task;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a task entity type.
 */
interface TaskInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the task title.
   *
   * @return string
   *   Title of the task.
   */
  public function getTitle();

  /**
   * Sets the task title.
   *
   * @param string $title
   *   The task title.
   *
   * @return \Drupal\task\TaskInterface
   *   The called task entity.
   */
  public function setTitle($title);

  /**
   * Gets the task creation timestamp.
   *
   * @return int
   *   Creation timestamp of the task.
   */
  public function getCreatedTime();

  /**
   * Sets the task creation timestamp.
   *
   * @param int $timestamp
   *   The task creation timestamp.
   *
   * @return \Drupal\task\TaskInterface
   *   The called task entity.
   */
  public function setCreatedTime($timestamp);

}
