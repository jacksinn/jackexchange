<?php

namespace Drupal\lesson_step\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Lesson Step type entity.
 *
 * @ConfigEntityType(
 *   id = "lesson_step_entity_type",
 *   label = @Translation("Lesson Step type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lesson_step\LessonStepEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lesson_step\Form\LessonStepEntityTypeForm",
 *       "edit" = "Drupal\lesson_step\Form\LessonStepEntityTypeForm",
 *       "delete" = "Drupal\lesson_step\Form\LessonStepEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lesson_step\LessonStepEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "lesson_step_entity_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "lesson_step_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/lesson_step_entity_type/{lesson_step_entity_type}",
 *     "add-form" = "/admin/structure/lesson_step_entity_type/add",
 *     "edit-form" = "/admin/structure/lesson_step_entity_type/{lesson_step_entity_type}/edit",
 *     "delete-form" = "/admin/structure/lesson_step_entity_type/{lesson_step_entity_type}/delete",
 *     "collection" = "/admin/structure/lesson_step_entity_type"
 *   }
 * )
 */
class LessonStepEntityType extends ConfigEntityBundleBase implements LessonStepEntityTypeInterface {

  /**
   * The Lesson Step type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Lesson Step type label.
   *
   * @var string
   */
  protected $label;

}
