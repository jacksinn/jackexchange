<?php

namespace Drupal\jackexchange\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Lesson entity type entity.
 *
 * @ConfigEntityType(
 *   id = "lesson_entity_type",
 *   label = @Translation("Lesson entity type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\jackexchange\LessonEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\jackexchange\Form\LessonEntityTypeForm",
 *       "edit" = "Drupal\jackexchange\Form\LessonEntityTypeForm",
 *       "delete" = "Drupal\jackexchange\Form\LessonEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\jackexchange\LessonEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "lesson_entity_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "lesson_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/lesson_entity_type/{lesson_entity_type}",
 *     "add-form" = "/admin/structure/lesson_entity_type/add",
 *     "edit-form" = "/admin/structure/lesson_entity_type/{lesson_entity_type}/edit",
 *     "delete-form" = "/admin/structure/lesson_entity_type/{lesson_entity_type}/delete",
 *     "collection" = "/admin/structure/lesson_entity_type"
 *   }
 * )
 */
class LessonEntityType extends ConfigEntityBundleBase implements LessonEntityTypeInterface {

  /**
   * The Lesson entity type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Lesson entity type label.
   *
   * @var string
   */
  protected $label;

}
