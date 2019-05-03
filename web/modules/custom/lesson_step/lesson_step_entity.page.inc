<?php

/**
 * @file
 * Contains lesson_step_entity.page.inc.
 *
 * Page callback for Lesson Step entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lesson Step templates.
 *
 * Default template: lesson_step_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lesson_step_entity(array &$variables) {
  // Fetch LessonStepEntity Entity Object.
  $lesson_step_entity = $variables['elements']['#lesson_step_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
