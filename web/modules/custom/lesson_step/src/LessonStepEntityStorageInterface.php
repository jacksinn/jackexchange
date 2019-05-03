<?php

namespace Drupal\lesson_step;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\lesson_step\Entity\LessonStepEntityInterface;

/**
 * Defines the storage handler class for Lesson Step entities.
 *
 * This extends the base storage class, adding required special handling for
 * Lesson Step entities.
 *
 * @ingroup lesson_step
 */
interface LessonStepEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Lesson Step revision IDs for a specific Lesson Step.
   *
   * @param \Drupal\lesson_step\Entity\LessonStepEntityInterface $entity
   *   The Lesson Step entity.
   *
   * @return int[]
   *   Lesson Step revision IDs (in ascending order).
   */
  public function revisionIds(LessonStepEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Lesson Step author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Lesson Step revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\lesson_step\Entity\LessonStepEntityInterface $entity
   *   The Lesson Step entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(LessonStepEntityInterface $entity);

  /**
   * Unsets the language for all Lesson Step with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
