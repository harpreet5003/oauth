<?php
require_once('config.php');

if(trim($_SESSION["access_token"]) != ''){
  header('Location: '.$GLOBALS['CLIENT_URL'].'user.php');
}

$query = http_build_query(array(
    'client_id' => $_SESSION["app_id"],
    'redirect_uri' => $GLOBALS['CLIENT_URL'].'callback.php',
    'response_type' => 'code',
    'scope' => '',
));

header('Location: '.$GLOBALS['API_URL'].'oauth/authorize?'.$query);
