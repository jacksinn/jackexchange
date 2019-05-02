<?php

namespace Drupal\jackexchange\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lesson entity entities.
 *
 * @ingroup jackexchange
 */
interface LessonEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

    public function getScore();

  /**
   * Gets the Lesson entity name.
   *
   * @return string
   *   Name of the Lesson entity.
   */
  public function getName();

  /**
   * Sets the Lesson entity name.
   *
   * @param string $name
   *   The Lesson entity name.
   *
   * @return \Drupal\jackexchange\Entity\LessonEntityInterface
   *   The called Lesson entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lesson entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lesson entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lesson entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lesson entity creation timestamp.
   *
   * @return \Drupal\jackexchange\Entity\LessonEntityInterface
   *   The called Lesson entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lesson entity published status indicator.
   *
   * Unpublished Lesson entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lesson entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lesson entity.
   *
   * @param bool $published
   *   TRUE to set this Lesson entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jackexchange\Entity\LessonEntityInterface
   *   The called Lesson entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Lesson entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Lesson entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\jackexchange\Entity\LessonEntityInterface
   *   The called Lesson entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Lesson entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Lesson entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\jackexchange\Entity\LessonEntityInterface
   *   The called Lesson entity entity.
   */
  public function setRevisionUserId($uid);

}
