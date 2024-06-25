<?php

namespace Drupal\digitalhealth\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'AutocompleteBlock' block.
 *
 * @Block(
 *   id = "autocomplete_block",
 *   admin_label = @Translation("Autocomplete Block"),
 * )
 */
class AutocompleteBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['search_form'] = [
      '#type' => 'form',
      '#attributes' => [
        'method' => 'GET',
        'action' => '/search',
      ],
      'search_image' => [
        '#type' => 'html_tag',
        '#tag' => 'img',
        '#attributes' => [
          'src' => '/themes/digital/image/icons/search-blue.svg',
          'alt' => 'Search',
          'width' => '20',
          'id' => 'search_image',
        ],
      ],
      'search_input' => [
        '#type' => 'textfield',
        '#attributes' => [
          'id' => 'autocomplete-input',
          'class' => ['search-input'],
          'style' => 'margin: 0; height: 38px',
          'name' => 'keyword',
          'placeholder' => 'Search',
        ],
        '#autocomplete_route_name' => 'it_app.suggestions', // Set the autocomplete route
        '#value' => \Drupal::request()->query->get('keyword', ''),
        '#attached' => [
          'library' => [
            'digitalhealth/autocomplete',
          ],
        ],
      ],
    ];

    $build['search_form_wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['search d-none d-md-block'],
      ],
      'search_form' => $build['search_form'],
    ];

    return $build['search_form_wrapper'];
  }

}
