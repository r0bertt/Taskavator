<?php

namespace Drupal\task_user_registration_form_alter\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class TaskUserRegistrationFormAlter extends RegisterForm {

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['field_roles'] = [
      '#title' => 'Role',
      '#type' => 'select',
      '#description' => 'Select the Role in The Project',
      '#options' => [
        'tech lead' => $this->t('Tech Lead'),
        'developer' => $this->t('Developer'),
      ],
      '#empty_option' => '- Select Your Role -',
      '#required' => 'TRUE',
      '#weight' => 5,
    ];

    $form['field_github'] = [
      '#title' => 'Github',
      '#type' => 'textfield',
      '#description' => 'Please enter a full link to your Github',
      '#placeholder' => 'https://github.com/',
      '#states' => [
        'visible' => [
          ":input[name='field_roles']" => ['value' => 'tech lead'],
        ],
      ],
      '#weight' => 5,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {


  }

}
