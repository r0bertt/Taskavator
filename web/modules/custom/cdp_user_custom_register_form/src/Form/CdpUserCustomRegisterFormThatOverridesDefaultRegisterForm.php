<?php

namespace Drupal\cdp_user_custom_register_form\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class CdpUserCustomRegisterFormThatOverridesDefaultRegisterForm extends RegisterForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['custom_greeting'] = [
      '#type' => 'inline_template',
      '#template' => '<h3>This form overrides default user registration form!</h3>',
    ];

    return parent::buildForm($form, $form_state);
  }

  public function save(array $form, FormStateInterface $form_state) {
    $role_id = 'cdp_custom_registered_user';
    $this->entity->set('roles', $role_id);
    parent::save($form, $form_state);
  }

}
