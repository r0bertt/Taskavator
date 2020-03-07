<?php

namespace Drupal\task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\task\Entity\Task;

class TaskDeveloperController extends ControllerBase {

  public function timeForm($id) {

    $entity_form_builder = \Drupal::service('entity.form_builder');
    $entity_type_manager = \Drupal::entityTypeManager();
    $task_storage = $entity_type_manager->getStorage('task');
    $developer = $task_storage->load($id);

    if (!$developer == NULL) {
      return $content['developers_form'] = $entity_form_builder->getForm($developer, 'spent_time_developer');
    }
    else {
      return $content['developers_form'] = [
        '#markup' => $this->t('There is no task under that ID'),
      ];
    }
  }

}
