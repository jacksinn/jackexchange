<?php

/**
 * @file
 * Contains lesson_entity.page.inc.
 *
 * Page callback for Lesson entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lesson entity templates.
 *
 * Default template: lesson_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lesson_entity(array &$variables) {
  // Fetch LessonEntity Entity Object.
  $lesson_entity = $variables['elements']['#lesson_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
