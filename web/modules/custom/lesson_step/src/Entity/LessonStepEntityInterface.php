<?php

namespace Drupal\lesson_step\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lesson Step entities.
 *
 * @ingroup lesson_step
 */
interface LessonStepEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lesson Step name.
   *
   * @return string
   *   Name of the Lesson Step.
   */
  public function getName();

  /**
   * Sets the Lesson Step name.
   *
   * @param string $name
   *   The Lesson Step name.
   *
   * @return \Drupal\lesson_step\Entity\LessonStepEntityInterface
   *   The called Lesson Step entity.
   */
  public function setName($name);

  /**
   * Gets the Lesson Step creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lesson Step.
   */
  public function getCreatedTime();

  /**
   * Sets the Lesson Step creation timestamp.
   *
   * @param int $timestamp
   *   The Lesson Step creation timestamp.
   *
   * @return \Drupal\lesson_step\Entity\LessonStepEntityInterface
   *   The called Lesson Step entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lesson Step published status indicator.
   *
   * Unpublished Lesson Step are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lesson Step is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lesson Step.
   *
   * @param bool $published
   *   TRUE to set this Lesson Step to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lesson_step\Entity\LessonStepEntityInterface
   *   The called Lesson Step entity.
   */
  public function setPublished($published);

  /**
   * Gets the Lesson Step revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Lesson Step revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\lesson_step\Entity\LessonStepEntityInterface
   *   The called Lesson Step entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Lesson Step revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Lesson Step revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\lesson_step\Entity\LessonStepEntityInterface
   *   The called Lesson Step entity.
   */
  public function setRevisionUserId($uid);

}
