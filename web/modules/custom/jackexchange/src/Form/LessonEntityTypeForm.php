<?php

namespace Drupal\jackexchange\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LessonEntityTypeForm.
 */
class LessonEntityTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $lesson_entity_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $lesson_entity_type->label(),
      '#description' => $this->t("Label for the Lesson entity type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $lesson_entity_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\jackexchange\Entity\LessonEntityType::load',
      ],
      '#disabled' => !$lesson_entity_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $lesson_entity_type = $this->entity;
    $status = $lesson_entity_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Lesson entity type.', [
          '%label' => $lesson_entity_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Lesson entity type.', [
          '%label' => $lesson_entity_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($lesson_entity_type->toUrl('collection'));
  }

}
