<?php

namespace Drupal\lesson_step;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lesson Step entities.
 *
 * @ingroup lesson_step
 */
class LessonStepEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Lesson Step ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\lesson_step\Entity\LessonStepEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lesson_step_entity.edit_form',
      ['lesson_step_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
