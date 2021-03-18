<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thomas John
 * Date: 18/03/2021
 * Time: 20:00
 */

namespace Drupal\axelerant_custom\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AxelerantCustomActionController.
 *
 * @package Drupal\axelerant_custom\Entity\Controller
 */
class AxelerantCustomActionController extends ControllerBase {

  /**
   * Display custom Json Page.
   *
   * @param $api_key
   *   Site Api Key.
   * @param $nid
   *   Node ID.
   *
   * @return RedirectResponse/JsonResponse
   *   Returns an array for data layer push.
   */
  public function customJsonPage($api_key = NULL, $nid = NULL)
  {
    if ((empty($api_key)) || (empty($nid))) {
      //Redirect to access denied page if parameter missing
      return new RedirectResponse(Url::fromRoute('system.403')->toString());
    }
    else {
      $site_api_key = \Drupal::state()->get('siteapikey');
      if (($api_key == $site_api_key) && ($nid == 1)) {
        //Return a Json response with success message
        $success_message = "<div class='success-message'>You have successfully accessed the page</div>";
        $jsonResponse = new JsonResponse($success_message);
        return $jsonResponse;
      }
      else {
        //Redirect to access denied page
        return new RedirectResponse(Url::fromRoute('system.403')->toString());
      }
    }
  }

}
