<?php
require_once('config.php');
if(trim($_SESSION["access_token"]) != ''){
  header('Location: '.$GLOBALS['CLIENT_URL'].'user.php');
}
if(isset($_POST['app_id']) && trim($_POST['app_id']) != '' && trim($_POST['app_sec']) != '') {
  $_SESSION["app_id"] = $_POST['app_id'];
  $_SESSION["app_sec"] = $_POST['app_sec'];
  header('Location: '.$GLOBALS['CLIENT_URL'].'authorize.php');
  exit;
}
?>
<html>
  <body>
    <form method="post">
      <label>App ID</label>
      <input type="text" name="app_id" />
      <label>App Secret</label>
      <input type="text" name="app_sec" />
      <input type="submit" />
    </form>
  </body>
</html>
