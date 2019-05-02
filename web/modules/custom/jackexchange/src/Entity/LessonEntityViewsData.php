<?php

namespace Drupal\jackexchange\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lesson entity entities.
 */
class LessonEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
