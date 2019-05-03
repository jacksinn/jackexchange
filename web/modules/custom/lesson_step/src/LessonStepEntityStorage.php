<?php

namespace Drupal\lesson_step;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class LessonStepEntityStorage extends SqlContentEntityStorage implements LessonStepEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(LessonStepEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {lesson_step_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {lesson_step_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(LessonStepEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {lesson_step_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('lesson_step_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
