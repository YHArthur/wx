<?php
require_once "inc/common.php";
require_once "inc/wxapi.php";
require_once "db/wx_app_info.php";

// GET参数检查
if (!isset($_POST['url']))
  exit('need url');

$url = $_POST['url'];
$appid = Config::WX_APPID;

// 取得长链接转短链接
$ret = get_short_url($appid, $url);

$rtn_str = json_encode($ret);

if (isset($_GET['callback'])) {
  $callback = $_GET['callback'];
  exit("{$callback}({$rtn_str});");
} else {
  exit($rtn_str);
}
?>
