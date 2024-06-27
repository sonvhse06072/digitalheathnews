<?php

namespace Drupal\digitalhealth\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Url;

class AutocompleteController extends ControllerBase
{

  public function suggestions(Request $request)
  {
    $results = [];
    $input = $request->query->get('q');
    if ($input) {
      $orGroup = \Drupal::entityQuery('node')->orConditionGroup()
        ->condition('title', $input, 'CONTAINS')
        // Add another condition here
        ->condition('body', $input, 'CONTAINS')
        ->condition('field_tags.entity.name', $input, 'CONTAINS')
        ->condition('field_category.entity.name', $input, 'CONTAINS');

      $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'article')
        ->condition($orGroup)
        ->range(0, 10)
        ->accessCheck(FALSE);
      $nids = $query->execute();

      $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
      foreach ($nodes as $node) {
        $results[] = [
          'value' => $node->getTitle(),
          'label' => $node->getTitle(),
          'url' => Url::fromRoute('entity.node.canonical', ['node' => $node->id()])->toString()
        ];
      }
    }

    return new JsonResponse($results);
  }
}
