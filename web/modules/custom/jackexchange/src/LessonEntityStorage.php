<?php

namespace Drupal\jackexchange;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class LessonEntityStorage extends SqlContentEntityStorage implements LessonEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(LessonEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {lesson_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {lesson_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(LessonEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {lesson_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('lesson_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
