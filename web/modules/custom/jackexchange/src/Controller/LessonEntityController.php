<?php

namespace Drupal\jackexchange\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\jackexchange\Entity\LessonEntityInterface;

/**
 * Class LessonEntityController.
 *
 *  Returns responses for Lesson entity routes.
 */
class LessonEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Lesson entity  revision.
   *
   * @param int $lesson_entity_revision
   *   The Lesson entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($lesson_entity_revision) {
    $lesson_entity = $this->entityManager()->getStorage('lesson_entity')->loadRevision($lesson_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('lesson_entity');

    return $view_builder->view($lesson_entity);
  }

  /**
   * Page title callback for a Lesson entity  revision.
   *
   * @param int $lesson_entity_revision
   *   The Lesson entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($lesson_entity_revision) {
    $lesson_entity = $this->entityManager()->getStorage('lesson_entity')->loadRevision($lesson_entity_revision);
    return $this->t('Revision of %title from %date', ['%title' => $lesson_entity->label(), '%date' => format_date($lesson_entity->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Lesson entity .
   *
   * @param \Drupal\jackexchange\Entity\LessonEntityInterface $lesson_entity
   *   A Lesson entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(LessonEntityInterface $lesson_entity) {
    $account = $this->currentUser();
    $langcode = $lesson_entity->language()->getId();
    $langname = $lesson_entity->language()->getName();
    $languages = $lesson_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $lesson_entity_storage = $this->entityManager()->getStorage('lesson_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $lesson_entity->label()]) : $this->t('Revisions for %title', ['%title' => $lesson_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all lesson entity revisions") || $account->hasPermission('administer lesson entity entities')));
    $delete_permission = (($account->hasPermission("delete all lesson entity revisions") || $account->hasPermission('administer lesson entity entities')));

    $rows = [];

    $vids = $lesson_entity_storage->revisionIds($lesson_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\jackexchange\LessonEntityInterface $revision */
      $revision = $lesson_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $lesson_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.lesson_entity.revision', ['lesson_entity' => $lesson_entity->id(), 'lesson_entity_revision' => $vid]));
        }
        else {
          $link = $lesson_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.lesson_entity.translation_revert', ['lesson_entity' => $lesson_entity->id(), 'lesson_entity_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.lesson_entity.revision_revert', ['lesson_entity' => $lesson_entity->id(), 'lesson_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.lesson_entity.revision_delete', ['lesson_entity' => $lesson_entity->id(), 'lesson_entity_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['lesson_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
