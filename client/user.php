<?php
require_once('config.php');

if(trim($_SESSION["access_token"]) == ''){
  header('Location: '.$GLOBALS['CLIENT_URL']);
}
$access_token = $_SESSION["access_token"];

// get user details based on the access token
$ch = curl_init();
$url = $GLOBALS['API_URL'].'api/user/get';
$header = array(
'Authorization: Bearer '. $access_token
);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);
curl_close($ch);
$response = json_decode($result);
echo '<a href="' . $GLOBALS['CLIENT_URL'] . 'reset.php">Reset</a>
  <br /><br />
  <pre>';
print_r($response);
