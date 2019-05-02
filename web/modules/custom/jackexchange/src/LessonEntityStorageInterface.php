<?php

namespace Drupal\jackexchange;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\jackexchange\Entity\LessonEntityInterface;

/**
 * Defines the storage handler class for Lesson entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Lesson entity entities.
 *
 * @ingroup jackexchange
 */
interface LessonEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Lesson entity revision IDs for a specific Lesson entity.
   *
   * @param \Drupal\jackexchange\Entity\LessonEntityInterface $entity
   *   The Lesson entity entity.
   *
   * @return int[]
   *   Lesson entity revision IDs (in ascending order).
   */
  public function revisionIds(LessonEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Lesson entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Lesson entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\jackexchange\Entity\LessonEntityInterface $entity
   *   The Lesson entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(LessonEntityInterface $entity);

  /**
   * Unsets the language for all Lesson entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
