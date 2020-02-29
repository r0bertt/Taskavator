<?php

namespace Drupal\task_copyright\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Task Copyright module for Block.
 *
 * @Block (
 *   id = "task_copyright",
 *   admin_label = @Translation("Task Copyright"),
 *   category = @Translation("Taskavator")
 * )
 */
class TaskCopyright extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {

    return [
      'organization_name' => '',
      'year_origin' => '',
      'year_to_date' => '',
      'label_display' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['organization_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organization name'),
      '#default_value' => $this->configuration['organization_name'],
    ];

    $form['year_origin'] = [
      '#type' => 'datelist',
      '#title' => $this->t('Year origin from'),
      '#description' => $this->t('Leave blank if not necessary.'),
      '#default_value' => $this->configuration['year_origin'],
      '#date_part_order' => ['year'],
      '#date_year_range' => '1950:(@year-1)',
    ];

    $date = new \DateTime();
    $form['year_to_date'] = [
      '#type' => 'datelist',
      '#title' => $this->t('Year to date'),
      '#description' => $this->t('Leave blank then the current year (@year) automatically shows up.',
        ['@year' => $date->format('Y')]),
      '#default_value' => $this->configuration['year_to_date'],
      '#date_part_order' => ['year'],
      '#date_year_range' => '1950:@year',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['organization_name'] = $form_state->getValue('organization_name');
    $this->configuration['year_origin'] = $form_state->getValue('year_origin');
    $this->configuration['year_to_date'] = $form_state->getValue('year_to_date');
    dump($this);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $date = new \DateTime();

    // From $year_to_date to Present.
    $year_to_date = empty($this->configuration['year_to_date'])
      ? $date->format('Y')
      : $this->configuration['year_to_date'];

    if ($this->configuration['year_origin'] == 0 || $date->format('Y') == $this->configuration['year_origin']) {
      return
        [
          '#type' => 'markup',
          '#markup' => $this->t('Copyright &copy; @year @organization', [
            '@year' => $date->format('Y'),
            '@organization' => $this->configuration['organization_name'],
          ]),
        ];
    }
    else {
      return
        [
          '#type' => 'markup',
          '#markup' => $this->t('Copyright &copy; @year_origin - @year_to_date @organization', [
            '@year_origin' => $this->configuration['year_origin'],
            '@year_to_date' => $year_to_date,
            '@organization' => $this->configuration['organization_name'],
          ]),
        ];
    }
  }

}
