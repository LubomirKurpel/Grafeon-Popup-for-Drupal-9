<?php

namespace Drupal\grafeon_popup\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class GrafeonPopupController extends ControllerBase {

  public function showPopup() {
    // Get the popup settings.
    $config = $this->config('grafeon_popup.settings');
    $enabled = $config->get('enabled');
    $title = $config->get('title');
    $message = $config->get('message');

    // Only show the popup if enabled.
    if ($enabled) {
      return [
        '#markup' => '<div id="grafeon-popup" class="grafeon-popup">
                        <div class="popup-content">
                          <button id="close-popup" class="close-popup">&times;</button>
                          <h2>' . $title . '</h2>
                          <p>' . $message . '</p>
                        </div>
                      </div>',
        '#attached' => [
          'library' => [
            'grafeon_popup/popup',
          ],
        ],
      ];
    }

    return new Response();
  }

}
