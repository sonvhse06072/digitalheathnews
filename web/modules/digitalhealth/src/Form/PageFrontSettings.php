<?php

namespace Drupal\digitalhealth\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class PageFrontSettings extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['digitalhealth.page_front.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'page_front_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('digitalhealth.page_front.settings');

    $form['title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
    ];

    $form['description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description'),
      '#format' => $config->get('description')['format'],
      '#editor' => TRUE,
      '#rows' => 10,
      '#default_value' => $config->get('description')['value'],
      '#allowed_formats' => ['full_html'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('digitalhealth.page_front.settings')
      ->set('title', $form_state->getValue('title'))
      ->set('description', $form_state->getValue('description'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
