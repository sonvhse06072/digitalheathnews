<?php

declare(strict_types = 1);

namespace Drupal\digitalhealth\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Application Settings form.
 *
 * @ingroup it_content
 * @category Custom
 * @link https://www.dots.eco
 */
class SearchForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'search_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }
}
