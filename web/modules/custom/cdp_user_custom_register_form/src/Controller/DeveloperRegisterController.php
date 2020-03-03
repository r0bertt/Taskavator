<?php

namespace Drupal\cdp_user_custom_register_form\Controller;

use Drupal\Core\Controller\ControllerBase;

class DeveloperRegisterController extends ControllerBase {

  public function registerForm() {
    $entity_form_builder = \Drupal::service('entity.form_builder');
    $entity_type_manager = \Drupal::entityTypeManager();
    $user_storage = $entity_type_manager->getStorage('user');
    $developer = $user_storage->create();
    $content['register_for_developers_form'] = $entity_form_builder->getForm($developer, 'register_for_developers');

    return $content;
  }

}
