<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

function pre($array, $exit = true)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($exit) {
      exit();
    }
}

function url($url = '')
{
    $protocol = \Context::getContext()->link->protocol_link;
    $domain = \Context::getContext()->shop->domain;

    return $protocol . $domain . '/' . $url;
}

function AdminURL($url = '')
{
  $protocol = \Context::getContext()->link->protocol_link;
  $domain = \Context::getContext()->shop->domain;

  return $protocol . $domain . '/storeadmin/' . $url;
}

function isAjax()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      return true;
    }

    return false;
}

function AdminCSSURL()
{
    return url('application/themes/admin/assets/css/');
}

function AdminJSURL()
{
    return url('application/themes/admin/assets/js/');
}

function redirect($url = null, $status = 301, $headers = array())
{
    \Tools::Redirect($url);
}

function response($status, $message)
{
    $response = new JsonResponse(['status' => $status, 'message' => $message]);
    return $response;
}

function json($status, $message, $exit = true, $field = null)
{
    echo json_encode(['status' => $status, 'message' => $message, 'field' => $field]);
    if ($exit) {
        exit();
    }
}
