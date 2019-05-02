<?php

namespace Drupal\jackexchange;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lesson entity entity.
 *
 * @see \Drupal\jackexchange\Entity\LessonEntity.
 */
class LessonEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jackexchange\Entity\LessonEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lesson entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lesson entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lesson entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lesson entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lesson entity entities');
  }

}
