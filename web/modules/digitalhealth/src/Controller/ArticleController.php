<?php

namespace Drupal\digitalhealth\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Symfony\Component\HttpFoundation\Request;

class ArticleController
{
  public function ajaxLoadArticle(Request $request)
  {
    $data = $request->getContent();
    $decoded_data = json_decode($data, true);
    $page = $decoded_data['page'];

    $view_storage = \Drupal::entityTypeManager()
      ->getStorage('view');

    $view = $view_storage->load('article')->getExecutable();
    $view->initDisplay();
    $view->setDisplay('block_1');
    $view->setCurrentPage($page);
    $view->execute();

    $html = '';
    foreach ($view->result as $row) {

      $alias = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $row->_entity->nid->value);

      $link_url = $alias;
      $title = $row->_entity->title->value;
      $description = $row->_entity->body->summary ?? strip_tags($row->_entity->body->value);
      $img_src = $row->_entity->field_image->entity->uri->url;
      $date = date("d M Y", $row->_entity->changed->value);
      $category = $row->_entity->field_category->entity->name->value;
      $author = $row->_entity->uid->entity->name->value;
      $uid = $row->_entity->uid[0]->target_id;

      $html .= '<div class="card ' . strtolower($category) . '">
                        <a href="'.$link_url.'"><img alt="" class="card-img-top" src="' . $img_src . '"></a>
                        <div class="card-body">
                          <div class="date d-flex align-items-center gap-2">
                            <img width="15px" alt="" src="/themes/digital/image/icons/date.svg">
                            ' . $date . '
                          </div>
                          <h5 class="card-title mt-3 fw-bold">
                            <a href="'.$link_url.'">'. $title .'</a>
                          </h5>
                          <p class="card-text">' . ($description) . '</p>
                          <a href="' . $link_url . '" class="text-decoration-none text-dark"><strong>' . t("Read more") . '</strong></a>
                          <div class="card-meta d-flex justify-content-between align-items-center mt-4 gap-3">
                            <span>
                                <a href="/user-info/'. $uid .'">' . $author . '</a>
                            </span>
                            <a class="card-category" href="?category=' . $category . '">' . $category . '</a>
                          </div>
                        </div>
               </div>';
    }

    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand('.list-item', $html));

    $newPage = $page + 1;
    if ($newPage >= $view->pager->getPagerTotal()) {
      $newPage = -1;
    }

    $response->addCommand(new HtmlCommand('.load-more', $newPage));
    return $response;
  }
}
