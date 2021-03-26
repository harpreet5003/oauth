<?php
require_once('config.php');

if(trim($_SESSION["access_token"]) != ''){
  header('Location: '.$GLOBALS['CLIENT_URL'].'user.php');
}

if (isset($_REQUEST['code']) && $_REQUEST['code'])
{
    $ch = curl_init();
    $url = $GLOBALS['API_URL'].'oauth/token';

    $params = array(
        'grant_type' => 'authorization_code',
        'client_id' => $_SESSION["app_id"],
        'client_secret' => $_SESSION["app_sec"],
        'redirect_uri' => $GLOBALS['CLIENT_URL'].'callback.php',
        'code' => $_REQUEST['code']
    );

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $params_string = '';

    if (is_array($params) && count($params))
    {
        foreach($params as $key=>$value) {
            $params_string .= $key.'='.$value.'&';
        }

        rtrim($params_string, '&');

        curl_setopt($ch,CURLOPT_POST, count($params));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
    }

    $result = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($result);

    if (isset($response->access_token) && $response->access_token)
    {
       $_SESSION["access_token"] = $response->access_token;
       header('Location: '.$GLOBALS['CLIENT_URL'] . 'user.php');
    }
    else
    {
        echo 'Access Token not found.';
    }
}
