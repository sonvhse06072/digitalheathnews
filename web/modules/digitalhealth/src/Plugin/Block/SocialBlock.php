<?php

namespace Drupal\digitalhealth\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a custom block.
 *
 * @Block(
 *   id = "social_block",
 *   admin_label = @Translation("Social Block"),
 * )
 */
class SocialBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $config = $this->getConfiguration();
    $content = $config['content'] ?? '';
    return [
      '#theme' => 'block',
      '#attributes' => [
        'class' => ['custom-block'],
      ],
      '#content' => $content,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state): array
  {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    $form['content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Content'),
      '#default_value' => $config['content'] ?? ''
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state): void
  {
    $this->configuration['content'] = $form_state->getValue('content');
  }

}
