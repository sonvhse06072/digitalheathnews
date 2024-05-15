<?php

namespace Drupal\digitalhealth\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class PopupSettingsForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['popup_module.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'popup_module_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('popup_module.settings');

    $form['popup_title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Popup title'),
      '#default_value' => $config->get('popup_title'),
    ];

    $form['popup_content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Popup Content'),
      '#default_value' => $config->get('popup_content'),
    ];


    $form['display_after'] = [
      '#type' => 'number',
      '#title' => $this->t('Display Popup After (seconds)'),
      '#default_value' => $config->get('display_after') ?? 50,
      '#min' => 1,
    ];

    $form['cookie_lifetime'] = [
      '#type' => 'number',
      '#title' => $this->t('Cookie Lifetime (days)'),
      '#default_value' => $config->get('cookie_lifetime') ?? 30,
      '#min' => 1,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('popup_module.settings')
      ->set('popup_title', $form_state->getValue('popup_title'))
      ->set('popup_content', $form_state->getValue('popup_content'))
      ->set('display_after', $form_state->getValue('display_after'))
      ->set('cookie_lifetime', $form_state->getValue('cookie_lifetime'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
