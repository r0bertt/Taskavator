<?php

namespace Drupal\task_user_registration_form_alter\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class TaskUserRegistrationFormAlter extends RegisterForm {

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['field_github']['#states'] = [
      'visible' => [
        ":input[name='field_roles']" => ['value' => 'te'],
      ],
    ];

    $form['field_roles_container'] = [
      '#type' => 'container'
    ];

    $form['field_roles_container']['widget'] = [
      '#title' => 'Role',
      '#type' => 'select',
      '#description' => 'Select your role in the project',
      '#options' => [
        'te' => $this->t('Tech Lead'),
        'de' => $this->t('Developer'),
      ],
      '#empty_option' => '- Select Your Role -',
      '#required' => 'TRUE',
      '#name' => 'field_roles'
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $role_id = $form_state->getValue('field_roles');
    $form_state->setValue('roles', [$role_id]);

    return parent::submitForm($form, $form_state);
  }

}
