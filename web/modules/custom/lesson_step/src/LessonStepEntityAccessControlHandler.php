<?php

namespace Drupal\lesson_step;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lesson Step entity.
 *
 * @see \Drupal\lesson_step\Entity\LessonStepEntity.
 */
class LessonStepEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lesson_step\Entity\LessonStepEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lesson step entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lesson step entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lesson step entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lesson step entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lesson step entities');
  }

}
