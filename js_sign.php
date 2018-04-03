<?php
require_once "inc/common.php";
require_once "inc/wxapi.php";
require_once "db/wx_app_info.php";

// GET参数检查
if (!isset($_GET['url']))
  exit('need url');

$url = trim($_GET['url']);
$appid = Config::WX_APPID;

// 获取微信JsapiTicket
$ticket = get_jsapi_ticket($appid);
$timestamp = time();
$nonceStr = get_guid();

// 这里参数的顺序要按照 key 值 ASCII 码升序排序
$string = "jsapi_ticket={$ticket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
$signature = sha1($string);

$signPackage = array(
  "appid"     => $appid,
  "noncestr"  => $nonceStr,
  "timestamp" => $timestamp,
  "url"       => $url,
  "signature" => $signature,
  "rawString" => $string
);

$rtn_str = json_encode($signPackage);

if (isset($_GET['callback'])) {
  $callback = $_GET['callback'];
  exit("{$callback}({$rtn_str});");
} else {
  exit($rtn_str);
}
?>
