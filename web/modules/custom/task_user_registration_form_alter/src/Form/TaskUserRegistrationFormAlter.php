<?php

namespace Drupal\task_user_registration_form_alter\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class TaskUserRegistrationFormAlter extends RegisterForm {

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['field_github']['#states'] = [
      'visible' => [
        ":input[name='field_role']" => ['value' => 'te'],
      ],
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $role_id = $form_state->getValue('field_role');

    $transformed_roles = [];
    foreach ($role_id as $field_role) {
      if (isset($field_role['value'])) {
        $transformed_roles[] = $field_role['value'];
      }
    }
    if (!empty($transformed_roles)) {
      $form_state->setValue('roles', $transformed_roles);
    }

    return parent::submitForm($form, $form_state);
  }

}
